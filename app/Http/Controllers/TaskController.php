<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request, Activity $activity)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:daily,weekly',
            'days' => 'nullable|array',
        ]);

        Task::create([
            'activity_id' => $activity->id,
            'name' => $request->name,
            'type' => $request->type,
            'days' => $request->type === 'weekly' ? $request->days : null,
        ]);

        return redirect()->back();
    }
}
