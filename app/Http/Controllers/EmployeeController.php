<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Models\Leave;
use App\Models\Project;
use App\Models\Review;
use App\Models\Attendance;
use App\Models\Message;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\DatabaseNotification;

class EmployeeController extends Controller
{
    /**
     * Constructor to apply authentication and role middleware
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:employee']);
    }

    /**
     * Display the employee dashboard
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('employee.dashboard', ['user' => Auth::user()]);
    }

    /**
     * Display tasks with optional filters by status and date
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function tasks(Request $request)
    {
        $tasksQuery = Auth::user()->tasks();
        $tasks = $tasksQuery
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->date, fn($q) => $q->whereDate('due_date', $request->date))
            ->get(['id', 'title', 'status', 'due_date']);

        $stats = Cache::remember('employee_tasks_stats_' . Auth::id(), 60, function () use ($tasksQuery) {
            return [
                'completed' => $tasksQuery->where('status', 'completed')->count(),
                'pending' => $tasksQuery->where('status', 'pending')->count(),
                'in_progress' => $tasksQuery->where('status', 'in-progress')->count(),
                'due_today' => $tasksQuery->whereDate('due_date', now()->toDateString())->count(),
            ];
        });

        return view('employee.tasks', compact('tasks', 'stats'));
    }

    /**
     * Show the task edit form for the authenticated user
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function editTask(Task $task)
    {
        $this->authorize('update', $task);
        return view('employee.tasks.edit', compact('task'));
    }

    /**
     * Store a new task for the authenticated user
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeTask(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'status' => 'required|in:pending,in-progress,completed',
                'due_date' => 'required|date',
            ]);

            $task = Auth::user()->tasks()->create($validated);
            Cache::forget('employee_tasks_stats_' . Auth::id());
            return response()->json([
                'success' => true,
                'message' => 'Task created successfully',
                'data' => ['task' => $task],
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Task creation failed: ' . $e->getMessage(), ['user_id' => Auth::id()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to create task',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update an existing task
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function updateTask(Request $request, Task $task)
    {
        $this->authorize('update', $task);
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'status' => 'required|in:pending,in-progress,completed',
                'due_date' => 'required|date',
            ]);

            $task->update($validated);
            Cache::forget('employee_tasks_stats_' . Auth::id());
            return response()->json([
                'success' => true,
                'message' => 'Task updated successfully',
                'data' => ['task' => $task],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Task update failed: ' . $e->getMessage(), ['user_id' => Auth::id(), 'task_id' => $task->id]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to update task',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete a task
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroyTask(Task $task)
    {
        $this->authorize('delete', $task);
        try {
            $task->delete();
            Cache::forget('employee_tasks_stats_' . Auth::id());
            return response()->json([
                'success' => true,
                'message' => 'Task deleted successfully',
            ]);
        } catch (\Exception $e) {
            Log::error('Task deletion failed: ' . $e->getMessage(), ['user_id' => Auth::id(), 'task_id' => $task->id]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete task',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display attendance records for the authenticated user
     *
     * @return \Illuminate\View\View
     */
    public function attendance()
    {
        $user = Auth::user();
        $attendance = $user->attendance()->orderBy('date', 'desc')->get();
        $attendanceToday = $user->attendance()->where('date', now()->toDateString())->first();
        $totalDays = $attendance->count();
        $presentDays = $attendance->where('status', 'present')->count();
        $absentDays = $attendance->where('status', 'absent')->count();

        return view('employee.attendance', compact('attendance', 'attendanceToday', 'totalDays', 'presentDays', 'absentDays'));
    }

    /**
     * Clock in for the authenticated user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function clockIn()
    {
        try {
            $user = Auth::user();
            $attendance = $user->attendance()->where('date', now()->toDateString())->first();

            if ($attendance && $attendance->check_in) {
                return response()->json([
                    'success' => false,
                    'message' => 'Already clocked in today',
                ], 400);
            }

            $attendance = $user->attendance()->create([
                'date' => now()->toDateString(),
                'status' => 'present',
                'check_in' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Clocked in successfully',
                'data' => ['attendance' => $attendance],
            ]);
        } catch (\Exception $e) {
            Log::error('Clock-in failed: ' . $e->getMessage(), ['user_id' => Auth::id()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to clock in',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Clock out for the authenticated user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function clockOut()
    {
        try {
            $user = Auth::user();
            $attendance = $user->attendance()->where('date', now()->toDateString())->first();

            if (!$attendance || $attendance->check_out) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot clock out: No clock-in record or already clocked out',
                ], 400);
            }

            $attendance->update(['check_out' => now()]);
            return response()->json([
                'success' => true,
                'message' => 'Clocked out successfully',
                'data' => ['attendance' => $attendance],
            ]);
        } catch (\Exception $e) {
            Log::error('Clock-out failed: ' . $e->getMessage(), ['user_id' => Auth::id()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to clock out',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display projects assigned to the authenticated user
     *
     * @return \Illuminate\View\View
     */
    public function projects()
    {
        $projects = Auth::user()->projects()->get();
        return view('employee.projects', compact('projects'));
    }

    /**
     * Show details of a specific project
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\View\View
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function showProject(Project $project)
    {
        if (!$project->users->contains(Auth::id())) {
            abort(403, 'Unauthorized');
        }
        return view('employee.projects.show', compact('project'));
    }

    /**
     * Handle project submission by the authenticated user
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\RedirectResponse
     */
   public function submitProject(Request $request)
{
    $request->validate([
        'project_id' => 'required|exists:projects,id',
        'uiux_design' => 'required|file|mimes:pdf,jpg,png|max:2048',
        'report' => 'required|file|mimes:pdf|max:2048',
    ]);

    $project = Project::findOrFail($request->project_id);

    if (!$project->users->contains(Auth::id())) {
        return redirect()->back()->withErrors(['error' => 'You are not assigned to this project']);
    }

    $uiuxPath = $request->file('uiux_design')->store('submissions/uiux', 'public');
    $reportPath = $request->file('report')->store('submissions/reports', 'public');

    $project->submissions()->create([
        'user_id' => Auth::id(),
        'uiux_path' => $uiuxPath,
        'report_path' => $reportPath,
        'submitted_at' => now(),
    ]);

    return redirect()->back()->with('success', 'Submission successful!');
}



    /**
     * Display leave requests for the authenticated user
     *
     * @return \Illuminate\View\View
     */
    public function leaves()
    {
        $leaves = Auth::user()->leaves()->orderBy('created_at', 'desc')->get();
        return view('employee.leaves', compact('leaves'));
    }

    /**
     * Store a new leave request
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeLeave(Request $request)
{
    try {
        $validated = $request->validate([
            'leave_type' => 'required|in:Sick Leave,Vacation,Personal Leave,Maternity/Paternity',
            'start_date' => 'required|date|after_or_equal:' . now()->toDateString(),
            'end_date'   => 'required|date|after_or_equal:start_date',
            'reason'     => 'required|string|max:500',
            'terms'      => 'accepted',
        ]);

        $leave = Leave::create([
            'user_id'     => Auth::id(),
            'leave_type'  => $validated['leave_type'],
            'start_date'  => $validated['start_date'],
            'end_date'    => $validated['end_date'],
            'reason'      => $validated['reason'],
            'status'      => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Leave request submitted successfully!',
            'data'    => $leave,
        ], 201);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'errors'  => $e->errors(),
        ], 422);
    } catch (\Exception $e) {
        \Log::error('Leave request submission failed: ' . $e->getMessage(), ['user_id' => Auth::id()]);
        return response()->json([
            'success' => false,
            'message' => 'Failed to submit leave request',
            'error'   => $e->getMessage(),
        ], 500);
    }
}




    /**
     * Show the edit form for a leave request
     *
     * @param \App\Models\Leave $leave
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function editLeave(Leave $leave)
    {
        if ($leave->user_id !== Auth::id() || $leave->status !== 'pending') {
            return redirect()->back()->with('error', 'Unauthorized or leave not editable');
        }
        return view('employee.leaves.edit', compact('leave'));
    }

    /**
     * Update an existing leave request
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Leave $leave
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateLeave(Request $request, Leave $leave)
    {
        try {
            if ($leave->user_id !== Auth::id() || $leave->status !== 'pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized or leave not editable',
                ], 403);
            }

            $validated = $request->validate([
                'leave_type' => 'required|in:Sick Leave,Vacation,Personal Leave,Maternity/Paternity',
                'start_date' => 'required|date|after_or_equal:' . now()->toDateString(),
                'end_date' => 'required|date|after_or_equal:start_date',
                'reason' => 'required|string|max:500',
            ]);

            $leave->update($validated);
           return response()->json([
             'success' => true,
             'message' => 'Leave request updated successfully'
             ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Leave request update failed: ' . $e->getMessage(), ['user_id' => Auth::id(), 'leave_id' => $leave->id]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to update leave request',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete a leave request
     *
     * @param \App\Models\Leave $leave
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyLeave(Leave $leave)
    {
        try {
            if ($leave->user_id !== Auth::id() || $leave->status !== 'pending') {
                return redirect()->back()->with('error', 'Unauthorized or leave not cancellable');
            }
            $leave->delete();
            return redirect()->route('employee.leaves.index')->with('success', 'Leave request cancelled');
        } catch (\Exception $e) {
            Log::error('Leave request deletion failed: ' . $e->getMessage(), ['user_id' => Auth::id(), 'leave_id' => $leave->id]);
            return redirect()->back()->with('error', 'Failed to cancel leave request: ' . $e->getMessage());
        }
    }

    /**
     * Display performance dashboard
     *
     * @return \Illuminate\View\View
     */
    public function performance()
    {
        $user = Auth::user();
        $performance = Cache::remember('employee_performance_' . Auth::id(), 60, function () use ($user) {
            return [
                'task_completion' => $this->calculateTaskCompletion($user),
                'task_completion_change' => $this->calculateTaskCompletionChange($user),
                'avg_rating' => $this->calculateAvgRating($user),
                'review_count' => $user->reviews()->count(),
                'completed_projects' => $user->projects()->where('projects.status', 'completed')->count(),
            ];
        });
        $performanceTrend = Cache::remember('employee_performance_trend_' . Auth::id(), 60, function () use ($user) {
            return $this->getPerformanceTrend($user);
        });
        $reviews = $user->reviews()->orderBy('created_at', 'desc')->take(3)->get();

        return view('employee.performance', compact('performance', 'performanceTrend', 'reviews'));
    }

    /**
     * Calculate task completion percentage
     *
     * @param \App\Models\User $user
     * @return int
     */
    private function calculateTaskCompletion($user)
    {
        $totalTasks = $user->tasks()->count();
        $completedTasks = $user->tasks()->where('status', 'completed')->count();
        return $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
    }

    /**
     * Calculate change in task completion from last month
     *
     * @param \App\Models\User $user
     * @return int
     */
    private function calculateTaskCompletionChange($user)
    {
        $lastMonthTasks = $user->tasks()->where('created_at', '<', now()->subMonth())->count();
        $lastMonthCompleted = $user->tasks()->where('status', 'completed')->where('created_at', '<', now()->subMonth())->count();
        $lastMonthPercentage = $lastMonthTasks > 0 ? round(($lastMonthCompleted / $lastMonthTasks) * 100) : 0;
        $currentPercentage = $this->calculateTaskCompletion($user);
        return round($currentPercentage - $lastMonthPercentage);
    }

    /**
     * Calculate average rating from reviews
     *
     * @param \App\Models\User $user
     * @return float
     */
    private function calculateAvgRating($user)
    {
        return $user->reviews()->exists() ? round($user->reviews()->avg('rating'), 1) : 0.0;
    }

    /**
     * Get performance trend over the last 6 months
     *
     * @param \App\Models\User $user
     * @return array
     */
    private function getPerformanceTrend($user)
    {
        $months = [];
        $scores = [];
        for ($i = 6; $i >= 0; $i--) {
            $month = now()->subMonths($i)->format('M');
            $months[] = $month;
            $reviews = $user->reviews()->whereMonth('created_at', now()->subMonths($i)->month)->avg('rating');
            $scores[] = $reviews ? round($reviews, 1) : 0.0;
        }
        return ['months' => $months, 'scores' => $scores];
    }

    /**
     * Display all performance reviews
     *
     * @return \Illuminate\View\View
     */
    public function performanceReviews()
    {
        $reviews = Auth::user()->reviews()->orderBy('created_at', 'desc')->paginate(10);
        return view('employee.performance-reviews', compact('reviews'));
    }

    /**
     * Display settings page
     *
     * @return \Illuminate\View\View
     */
    public function settings()
    {
        return view('employee.settings', ['user' => Auth::user()]);
    }

    /**
     * Update user settings
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateSettings(Request $request)
    {
        try {
            $validated = $request->validate([
                'email_notifications' => 'required|boolean',
                'push_notifications' => 'required|boolean',
                'sms_notifications' => 'required|boolean',
                'theme' => 'required|in:light,dark,system',
                'language' => 'required|in:en,hi,es',
                'chat_notifications' => 'required|boolean',
                'chat_online_status' => 'required|boolean',
            ]);

            if (!($validated['email_notifications'] || $validated['push_notifications'] || $validated['sms_notifications'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => ['notification' => ['At least one notification type must be enabled']],
                ], 422);
            }

            $user = Auth::user();
            $user->update(['settings' => array_merge($user->settings ?? [], $validated)]);
            return response()->json([
                'success' => true,
                'message' => 'Settings updated successfully',
                'data' => ['settings' => $user->settings],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Settings update failed: ' . $e->getMessage(), ['user_id' => Auth::id()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to update settings',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display profile page
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        $user = Auth::user();
        $employee = $user->employee;
        return view('employee.profile', compact('user', 'employee'));
    }

    /**
     * Update user profile
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(Request $request)
    {
        try {
            $validated = $request->validate([
                'address' => 'nullable|string|max:255',
                'bio' => 'nullable|string|max:500',
            ]);

            $user = Auth::user();
            $user->update([
                'address' => $validated['address'] ?? null,
                'bio' => $validated['bio'] ?? null,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully',
                'data' => [
                    'address' => $user->address,
                    'bio' => $user->bio,
                ],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Profile update failed: ' . $e->getMessage(), ['user_id' => Auth::id()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to update profile',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update user profile picture
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfilePicture(Request $request)
    {
        try {
            $validated = $request->validate([
                'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:500',
            ]);

            $user = Auth::user();
            if ($request->hasFile('profile_picture')) {
                $fileName = time() . '.' . $request->file('profile_picture')->extension();
                $request->file('profile_picture')->storeAs('public', $fileName);
                if ($user->profile_picture) {
                    Storage::delete('public/' . $user->profile_picture);
                }
                $user->update(['profile_picture' => $fileName]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Profile picture updated successfully',
                'data' => ['profile_picture' => asset('storage/' . $user->profile_picture)],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Profile picture update failed: ' . $e->getMessage(), ['user_id' => Auth::id()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to update profile picture',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update user password
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePassword(Request $request)
    {
        try {
            $validated = $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|different:current_password',
                'new_password_confirmation' => 'required|same:new_password',
            ]);

            $user = Auth::user();
            if (!Hash::check($validated['current_password'], $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => ['current_password' => ['Current password is incorrect']],
                ], 422);
            }

            $user->update(['password' => Hash::make($validated['new_password'])]);
            return response()->json([
                'success' => true,
                'message' => 'Password updated successfully',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Password update failed: ' . $e->getMessage(), ['user_id' => Auth::id()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to update password',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Send a chat message
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendChat(Request $request)
    {
        try {
            $validated = $request->validate([
                'message' => 'required|string|max:500',
                'receiver_id' => 'required|exists:users,id',
            ]);

            $message = Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $validated['receiver_id'],
                'content' => $validated['message'],
                'created_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully',
                'data' => ['message' => $message],
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Chat message send failed: ' . $e->getMessage(), ['user_id' => Auth::id(), 'receiver_id' => $request->receiver_id]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to send message',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Fetch chat messages
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchChatMessages(Request $request)
    {
        try {
            $lastId = $request->input('last_id', 0);
            $messages = Message::where('id', '>', $lastId)
                ->where(function ($query) {
                    $query->where('sender_id', Auth::id())
                          ->orWhere('receiver_id', Auth::id());
                })
                ->with('sender')
                ->orderBy('created_at', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Messages fetched successfully',
                'data' => ['messages' => $messages],
            ]);
        } catch (\Exception $e) {
            Log::error('Chat messages fetch failed: ' . $e->getMessage(), ['user_id' => Auth::id()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch messages',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Fetch notifications
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    // Display all notifications
    public function notifications()
    {
        $notifications = Auth::user()->notifications()->latest()->get();
        return view('employee.notifications', compact('notifications'));
    }



    public function fetchNotifications(Request $request)
{
    $lastId = $request->last_id ?? 0;

    $notifications = auth()->user()->unreadNotifications()
                          ->where('id', '>', $lastId)
                          ->latest()
                          ->get();

    return response()->json([
        'success' => true,
        'notifications' => $notifications,
    ]);
}

    // Mark single notification as read
    public function markNotificationRead($id)
    {
        $notification = Auth::user()->notifications()->where('id', $id)->firstOrFail();
        $notification->markAsRead();
        return redirect()->back()->with('success', 'Notification marked as read.');
    }

    // Mark all notifications as read
    public function markAllNotificationsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back()->with('success', 'All notifications marked as read.');
    }
}
