<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $activities = Activity::where('user_id', Auth::id())->get();
        return view('reports.index', compact('activities'));
    }

    public function show(Activity $activity)
    {
        $activity->load('tasks.logs');

        $today = Carbon::today();
        $range = request('range', 'monthly');
        $weekOffset = request('week', 0);

        $activityStart = Carbon::parse($activity->start_date);

        // TOTAL HARI SEJAK DIBUAT (GLOBAL)
        $totalDaysRunning = $activityStart->diffInDays($today) + 1;

        /** =====================
         * TENTUKAN RENTANG TANGGAL
         * ===================== */
        if ($range === 'weekly') {
            $startDate = $today->copy()->startOfWeek()->addWeeks($weekOffset);
            $endDate = $startDate->copy()->endOfWeek();

            // Batasi agar tidak lompat ke minggu setelah minggu berjalan
            if ($startDate->greaterThan($today->copy()->startOfWeek())) {
                $startDate = $today->copy()->startOfWeek();
                $endDate = $today->copy()->endOfWeek();
            }
        } else {
            // BULANAN
            $startDate = $today->copy()->startOfMonth();
            $endDate = $today->copy()->endOfMonth();
        }

        // Jangan melewati sebelum activity dibuat
        if ($startDate->lessThan($activityStart)) {
            $startDate = $activityStart->copy();
        }

        /** =====================
         * GENERATE TANGGAL
         * ===================== */
        $dates = collect();
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $dates->push($date->copy());
        }

        /** =====================
         * HITUNG RINGKASAN
         * ===================== */
        $summary = [
            'success' => 0,
            'fail' => 0,
            'pending' => 0,
        ];

        foreach ($activity->tasks as $task) {
            foreach ($dates as $date) {

                // Future date tidak dihitung
                if ($date->greaterThan($today)) {
                    continue;
                }

                // Skip hari non-aktif untuk weekly task
                if ($task->type === 'weekly') {
                    if (!in_array(strtolower($date->format('D')), $task->days ?? [])) {
                        continue;
                    }
                }

                $log = $task->logs->first(
                    fn ($l) => $l->log_date->toDateString() === $date->toDateString()
                );

                if (!$log) {
                    $summary['pending']++;
                } elseif ($log->status === 'success') {
                    $summary['success']++;
                } elseif ($log->status === 'fail') {
                    $summary['fail']++;
                }
            }
        }

        return view('reports.show', compact(
            'activity',
            'dates',
            'summary',
            'range',
            'weekOffset',
            'totalDaysRunning',
            'today'
        ));
    }
}
