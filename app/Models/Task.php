<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\TaskGroup;

class Task extends Model
{
    //
    protected $fillable = [
        'task',
        'user_id',
        'task_group_id',
        'deadline',
        'completed_at'
    ];

    protected $appends = [
        'is_completed',
        'is_near_deadline'
    ];

    public function taskGroup()
    {
        return $this->belongsToMany(TaskGroup::class);
    }

    protected function getIsCompletedAttribute()
    {
        return $this->completed_at !== null;
    }

    protected function casts()
    {
        return [
            'completed_at' => 'datetime',
            'deadline' => 'datetime'
        ];
    }

    protected function getIsNearDeadlineAttribute()
    {
        $date = new Carbon($this->deadline);
        return $date->diffInDays(Carbon::now(), true) <= 3 ? true : false;
    }
}
