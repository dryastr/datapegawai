<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())
            ->where(function ($query) {
                $query->where('status', '!=', 'completed')
                    ->where('status', '!=', 'rejected')
                    ->orWhereNull('status');
            })
            ->whereDoesntHave('reports', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();

        return view('user.tasks.index', compact('tasks'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('user.tasks.show', compact('task'));
    }

    public function accept(Task $task)
    {
        $task->update(['status' => 'accepted']);
        return redirect()->route('tasks-user.index')->with('success', 'Tugas berhasil diterima.');
    }

    public function reject(Task $task)
    {
        $task->update(['status' => 'rejected']);
        return redirect()->route('tasks-user.index')->with('success', 'Tugas berhasil ditolak.');
    }

    public function complete(Task $task)
    {
        $task->update(['status' => 'completed']);
        return redirect()->route('tasks-user.index')->with('success', 'Tugas berhasil diselesaikan.');
    }

}
