<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class UserController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        $pendingCount = $tasks->where('status', 'pending')->count();
        $rejectedCount = $tasks->where('status', 'rejected')->count();
        $completedCount = $tasks->where('status', 'completed')->count();
        $processCount = $tasks->where('status', 'process')->count();

        $user = Auth::user();

        $data = [
            'tasks' => $tasks,
            'pendingCount' => $pendingCount,
            'rejectedCount' => $rejectedCount,
            'completedCount' => $completedCount,
            'processCount' => $processCount,
            'user' => $user,
        ];

        return view('home', $data);
    }
}
