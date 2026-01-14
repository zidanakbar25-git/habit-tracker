<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'name',
        'type',
        'days',
    ];

    protected $casts = [
        'days' => 'array',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }


    public function logs()
{
    return $this->hasMany(TaskLog::class);
}

}
