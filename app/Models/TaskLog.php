<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'log_date',
        'status',
    ];

    protected $casts = [
        'log_date' => 'date',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
