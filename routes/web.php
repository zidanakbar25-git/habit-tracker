<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('activities.index');
    }
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('activities.index');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


use App\Http\Controllers\ActivityController;
use App\Http\Controllers\TaskController;

Route::middleware(['auth'])->group(function () {
    Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
    Route::post('/activities', [ActivityController::class, 'store'])->name('activities.store');
});


// Task routes


Route::middleware(['auth'])->group(function () {
    Route::get('/activities/{activity}', function (\App\Models\Activity $activity) {
        return view('activities.show', compact('activity'));
    })->name('activities.show');

    Route::post('/activities/{activity}/tasks', [TaskController::class, 'store'])
        ->name('tasks.store');
});


use App\Http\Controllers\TaskLogController;

Route::post('/tasks/{task}/toggle', [TaskLogController::class, 'toggle'])
    ->middleware('auth')
    ->name('tasks.toggle');

    Route::post('/tasks/{task}/status', [TaskLogController::class, 'setStatus'])
    ->middleware('auth')
    ->name('tasks.status');

Route::post('/tasks/{task}/clear', [TaskLogController::class, 'clearStatus'])
    ->middleware('auth')
    ->name('tasks.clear');


    use App\Http\Controllers\ReportController;

Route::middleware(['auth'])->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/{activity}', [ReportController::class, 'show'])->name('reports.show');
});
