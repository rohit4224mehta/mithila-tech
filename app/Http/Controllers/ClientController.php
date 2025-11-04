<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:client'])->except(['submitContactForm']);
    }

    /* ----------------------------
        📊 DASHBOARD
    -----------------------------*/
    public function dashboard()
    {
        $user = Auth::user();

        if (!$user) {
            Log::error('Unauthorized dashboard access attempt.');
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        $projects = $user->projects()->with('tasks')->latest()->get();
        $pendingTasks = $projects->flatMap->tasks->where('status', 'pending')->count();

        $chartData = [
            'labels' => $projects->pluck('name')->toArray(),
            'data'   => $projects->pluck('progress')->toArray(),
        ];

        return view('client.dashboard', [
            'projects'       => $projects,
            'chartData'      => $chartData,
            'projectCount'   => $projects->count(),
            'totalHours'     => $projects->sum('hours'),
            'pendingTasks'   => $pendingTasks,
            'recentProjects' => $projects->take(5),
        ]);
    }

    /* ----------------------------
        📁 PROJECTS
    -----------------------------*/
    public function projects()
    {
        $user = Auth::user();
        $projects = $user->projects()->orderByDesc('start_date')->paginate(10);

        return view('client.projects', compact('projects'));
    }

    public function projectDetail(Project $project)
{
    if ($project->client_id !== Auth::id()) {
        abort(403, 'Unauthorized access to project.');
    }

    return view('client.project-detail', compact('project'));
}

    /* ----------------------------
        👤 PROFILE
    -----------------------------*/
    public function profile()
    {
        return view('client.profile', ['user' => Auth::user()]);
    }

    public function editProfile()
    {
        return view('client.profile_edit', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email,' . $user->id,
            'phone'           => 'nullable|numeric|digits_between:7,15',
            'address'         => 'nullable|string|max:255',
            'bio'             => 'nullable|string|max:500',
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        $user->update($validated);

        if ($request->hasFile('profile_picture')) {
            $fileName = time() . '.' . $request->profile_picture->extension();
            $path = $request->file('profile_picture')->storeAs('public/profile_pictures', $fileName);

            if ($user->profile_picture && Storage::exists('public/profile_pictures/' . $user->profile_picture)) {
                Storage::delete('public/profile_pictures/' . $user->profile_picture);
            }

            $user->update(['profile_picture' => $fileName]);
        }

        return back()->with('success', 'Profile updated successfully!');
    }

    public function updateProfilePicture(Request $request)
    {
        $request->validate(['profile_picture' => 'required|image|max:2048']);
        $user = Auth::user();

        $fileName = time() . '.' . $request->profile_picture->extension();
        $request->file('profile_picture')->storeAs('public/profile_pictures', $fileName);

        if ($user->profile_picture && Storage::exists('public/profile_pictures/' . $user->profile_picture)) {
            Storage::delete('public/profile_pictures/' . $user->profile_picture);
        }

        $user->update(['profile_picture' => $fileName]);

        return response()->json([
            'success' => true,
            'profile_picture' => asset('storage/profile_pictures/' . $fileName),
        ]);
    }

    /* ----------------------------
        🔐 PASSWORD
    -----------------------------*/
    public function editPassword()
    {
        return view('client.change_password');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|string|min:8|different:current_password|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update(['password' => Hash::make($validated['new_password'])]);
        return back()->with('success', 'Password updated successfully!');
    }

    /* ----------------------------
        ⭐ FEEDBACK
    -----------------------------*/
    public function feedback()
    {
        $user = Auth::user();
        $projects = $user->projects;

        // Check if column exists (to avoid SQL errors)
        $feedbacks = collect();
        if (Schema::hasColumn('feedbacks', 'user_id')) {
            $feedbacks = Feedback::where('user_id', $user->id)->latest()->get();
        } elseif (Schema::hasColumn('feedbacks', 'client_id')) {
            $feedbacks = Feedback::where('client_id', $user->id)->latest()->get();
        } else {
            Log::error('❌ No user/client column found in feedbacks table');
        }

        $ratingCounts = $feedbacks->groupBy('rating')->map->count();

        return view('client.feedback', compact('projects', 'feedbacks', 'ratingCounts'));
    }

    public function submitFeedback(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'required|string|max:500',
        ]);

        $data = [
            'project_id' => $validated['project_id'],
            'rating'     => $validated['rating'],
            'comment'    => $validated['comment'],
        ];

        if (Schema::hasColumn('feedbacks', 'user_id')) {
            $data['user_id'] = Auth::id();
        } elseif (Schema::hasColumn('feedbacks', 'client_id')) {
            $data['client_id'] = Auth::id();
        }

        Feedback::create($data);

        return back()->with('success', 'Feedback submitted successfully!');
    }

    /* ----------------------------
        📬 CONTACT FORM
    -----------------------------*/
    public function submitContactForm(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string|max:1000',
        ]);

        Log::info('📨 Client contact form submitted', [
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return response()->json(['success' => true, 'message' => 'Thank you for your message!']);
    }
}
