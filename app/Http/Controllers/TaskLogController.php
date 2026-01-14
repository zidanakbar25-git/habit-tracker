<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskLog;
use Illuminate\Http\Request;

class TaskLogController extends Controller
{
    public function setStatus(Request $request, Task $task)
    {
        $request->validate([
            'date' => 'required|date',
            'status' => 'required|in:success,fail',
        ]);

        TaskLog::updateOrCreate(
            [
                'task_id' => $task->id,
                'log_date' => $request->date,
            ],
            [
                'status' => $request->status,
            ]
        );

        return redirect()->back();
    }

    public function clearStatus(Request $request, Task $task)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        TaskLog::where('task_id', $task->id)
            ->where('log_date', $request->date)
            ->delete();

        return redirect()->back();
    }
}
