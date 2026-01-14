<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::where('user_id', Auth::id())->get();

        return view('activities.index', compact('activities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
        ]);

        Activity::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'start_date' => $request->start_date,
        ]);

        return redirect()->back();
    }
}
