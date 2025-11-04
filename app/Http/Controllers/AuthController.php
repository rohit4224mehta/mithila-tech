<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Display the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * Handle user login.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }

        $user = Auth::user();

        if ($user->status === 'inactive' || ! $user->hasVerifiedEmail()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return back()->withErrors(['email' => 'Please verify your email before logging in.']);
        }

        $user->update(['last_login_at' => now()]);

        return redirect()->intended($this->redirectTo($user));
    }

    /**
     * Handle user logout.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        $email = Auth::user()->email ?? 'unknown';
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Log::info("User {$email} logged out.");
        return redirect()->route('login')->with('status', 'Logged out.');
    }

    /**
     * Display the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    /**
     * Handle user registration.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,employee,client'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => 'inactive',
        ]);

        if ($user->role === 'employee') {
            Employee::create([
                'user_id' => $user->id,
                'job_title' => 'Trainee',
                'department' => 'HR',
            ]);
        }

        // Send signed verification link
        $this->sendVerificationLinkTo($user);

        event(new Registered($user));

        return redirect()->route('verification.notice')->with('status', 'Registration successful! Check your email for the verification link.');
    }

    /**
     * Build and send a temporary-signed verification link (valid for 60 minutes).
     *
     * @param \App\Models\User $user
     * @return void
     */
    protected function sendVerificationLinkTo(User $user): void
    {
        $url = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->getEmailForVerification())],
            false // Relative URL
        );

        $fullUrl = config('app.url') . '/' . ltrim($url, '/');

        try {
            Mail::send('mails.verify-email', ['user' => $user, 'url' => $fullUrl], function ($msg) use ($user) {
                $msg->to($user->email)->subject('Verify Your Email - Mithila Tech');
            });
            Log::info("Verification email sent to {$user->email}");
        } catch (\Throwable $e) {
            Log::error("Failed to send verification email to {$user->email}: " . $e->getMessage());
        }
    }

    /**
     * Display the verification notice page.
     *
     * @return \Illuminate\View\View
     */
    public function showVerificationNotice(): View
    {
        return view('auth.verify');
    }

    /**
     * Handle email verification.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @param string $hash
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request, $id, $hash): RedirectResponse
    {
        try {
            // Log the attempt
            Log::info('Verification attempt', [
                'url' => $request->fullUrl(),
                'user_id' => $id,
                'hash' => $hash,
            ]);

            // Check if link signature is valid
            if (! $request->hasValidSignature()) {
                Log::warning('Invalid email verification link clicked', [
                    'url' => $request->fullUrl(),
                ]);
                return redirect()->route('login')->withErrors(['email' => 'Invalid or expired verification link.']);
            }

            // Get user record
            $user = User::find($id);
            if (! $user) {
                Log::error("Email verification failed — user not found for ID {$id}");
                return redirect()->route('login')->withErrors(['email' => 'User not found.']);
            }

            // Check hash integrity (case-insensitive)
            if (! hash_equals((string) $hash, sha1(strtolower($user->getEmailForVerification())))) {
                Log::warning("Verification hash mismatch for {$user->email}", [
                    'provided_hash' => $hash,
                    'expected_hash' => sha1(strtolower($user->getEmailForVerification())),
                ]);
                return redirect()->route('login')->withErrors(['email' => 'Invalid verification link.']);
            }

            // Update user
            $user->email_verified_at = now();
            $user->status = 'active';
            $saved = $user->save();

            if (! $saved) {
                Log::error("Failed to save user verification for {$user->email}");
                return redirect()->route('login')->withErrors(['email' => 'Failed to verify email. Please try again.']);
            }

            event(new Verified($user));
            Log::info("✅ {$user->email} email verified & status activated.");

            return redirect()
                ->route('login')
                ->with('success', 'Your email has been verified successfully! You can now log in.');

        } catch (\Exception $e) {
            Log::error('Email verification failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->route('login')->withErrors(['email' => 'Something went wrong. Please try again.']);
        }
    }

    /**
     * Resend verification email.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendVerificationEmail(Request $request): RedirectResponse
    {
        $email = $request->input('email');

        $user = $email ? User::where('email', $email)->first() : $request->user();

        if (! $user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        if ($user->hasVerifiedEmail()) {
            return back()->with('status', 'Email already verified.');
        }

        $this->sendVerificationLinkTo($user);
        return back()->with('resent', true);
    }

    /* ========================= OTP Password Reset ========================= */

    /**
     * Display the forgot password form.
     *
     * @return \Illuminate\View\View
     */
    public function showForgotPasswordForm(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Send password reset OTP.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetOtp(Request $request): RedirectResponse
    {
        $request->validate(['email' => ['required', 'email', 'exists:users,email']]);

        $user = User::where('email', $request->email)->firstOrFail();
        $otpPlain = random_int(100000, 999999);

        $user->update([
            'otp' => Hash::make((string) $otpPlain),
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        try {
            Mail::send('mails.otp', ['user' => $user, 'otp' => $otpPlain], function ($msg) use ($user) {
                $msg->to($user->email)->subject('MithilaTech Password Reset OTP');
            });
            Log::info("OTP sent to {$user->email}");
        } catch (\Throwable $e) {
            Log::error("OTP send failed: " . $e->getMessage());
            return back()->withErrors(['email' => 'Unable to send OTP.']);
        }

        return redirect()->route('password.reset.otp', ['email' => $user->email])
            ->with('status', 'OTP sent to your email (valid 10 minutes).');
    }

    /**
     * Display the reset password OTP form.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function showResetPasswordOtpForm(Request $request): View
    {
        if (! $request->has('email')) {
            return redirect()->route('password.request')->withErrors(['email' => 'Please enter email first.']);
        }
        return view('auth.reset-password-otp', ['email' => $request->email]);
    }

    /**
     * Handle password reset with OTP.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPasswordWithOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'otp' => ['required', 'digits:6'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! $user->otp || ! Hash::check($request->otp, $user->otp)) {
            return back()->withErrors(['otp' => 'Invalid OTP.'])->withInput();
        }

        if (now()->gt(Carbon::parse($user->otp_expires_at))) {
            return back()->withErrors(['otp' => 'OTP expired. Please request a new one.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
            'otp' => null,
            'otp_expires_at' => null,
        ]);

        Log::info("Password reset for {$user->email}");
        return redirect()->route('login')->with('status', 'Password reset successful. Please login.');
    }

    /**
     * Determine redirect path based on user role.
     *
     * @param \App\Models\User $user
     * @return string
     */
    protected function redirectTo(User $user): string
    {
        return match ($user->role) {
            'admin' => route('admin.dashboard'),
            'employee' => route('employee.dashboard'),
            'client' => route('client.dashboard'),
            default => route('home'),
        };
    }
}