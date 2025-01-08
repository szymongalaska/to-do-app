<?php

namespace App\Models;

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
    ];

    public function taskGroup()
    {
        $this->belongsTo(TaskGroup::class);
    }

    protected function getIsCompletedAttribute()
    {
        return $this->completed_at !== null;
    }

    protected function casts()
    {
        return [
            'completed_at' => 'datetime'
        ];
    }
}
