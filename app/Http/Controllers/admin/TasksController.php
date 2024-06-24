<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Str;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return view('admin.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $regions = Region::all();
        $users = User::where('role_id', 2)->get();
        $ticket = $this->generateTicket();

        return view('admin.tasks.create', compact('regions', 'users', 'ticket'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'region_id' => 'required',
            'user_id' => 'required',
            'task_title' => 'required',
            'task_schedule' => 'required|date',
            'task_detail' => 'required',
        ]);

        $ticket = $this->generateTicket();

        $task = new Task();
        $task->ticket = $ticket;
        $task->region_id = $request->region_id;
        $task->user_id = $request->user_id;
        $task->task_title = $request->task_title;
        $task->task_schedule = $request->task_schedule;
        $task->task_detail = $request->task_detail;
        $task->status = $request->status ?? 'pending';

        $task->ticket_schedule = now();

        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('admin.tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $regions = Region::all();
        $users = User::where('role_id', 2)->get();

        return view('admin.tasks.edit', compact('task', 'regions', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'region_id' => 'required',
            'user_id' => 'required',
            'task_title' => 'required',
            'task_schedule' => 'required|date',
            'ticket_schedule' => 'required|date',
            'task_detail' => 'required',
        ]);

        $task->update([
            'region_id' => $request->region_id,
            'user_id' => $request->user_id,
            'task_title' => $request->task_title,
            'task_schedule' => $request->task_schedule,
            'ticket_schedule' => $request->ticket_schedule,
            'task_detail' => $request->task_detail,
            'status' => $request->status ?? 'pending',
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    private function generateTicket()
    {
        $latestTask = Task::latest()->first();
        if ($latestTask) {
            $lastTicket = $latestTask->ticket;
            $lastNumber = intval(substr($lastTicket, 3));

            $newTicketNumber = $lastNumber + 1;

            $newTicket = sprintf('TKT%03d', $newTicketNumber);

            return $newTicket;
        } else {
            return 'TKT001';
        }
    }
}
