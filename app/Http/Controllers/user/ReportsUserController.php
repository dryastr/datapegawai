<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasksAccepted = Task::where('status', 'completed')
            ->where('user_id', Auth::id())
            ->whereDoesntHave('reports', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();

        $tasksRejected = Task::where('status', 'rejected')
            ->where('user_id', Auth::id())
            ->whereDoesntHave('reports', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();

        $tasks = $tasksAccepted->merge($tasksRejected);

        return view('user.reports.index', compact('tasks'));
    }


    public function all()
    {
        $reports = Report::where('user_id', Auth::id())->get();

        return view('user.reports.all-reports', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($taskId)
    {
        $task = Task::where('id', $taskId)->where('user_id', Auth::id())->firstOrFail();
        return view('user.reports.create', compact('task'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'report_detail' => 'required',
        ]);

        Report::create([
            'task_id' => $request->task_id,
            'user_id' => Auth::id(),
            'report_detail' => $request->report_detail,
        ]);

        return redirect()->route('reports-user-all.all-reports')->with('success', 'Report created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $report = Report::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('user.reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $report = Report::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('user.reports.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'report_detail' => 'required',
        ]);

        $report = Report::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $report->update([
            'report_detail' => $request->report_detail,
        ]);

        return redirect()->route('reports-user-all.all-reports')->with('success', 'Report updated successfully.');
    }

    public function cancel(Task $task)
    {
        $task->update(['status' => 'pending']);
        return redirect()->route('tasks-user.index')->with('success', 'Tugas berhasil dibatalkan.');
    }
}
