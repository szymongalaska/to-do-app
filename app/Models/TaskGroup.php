<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

class TaskGroup extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'color',
        'icon'
    ];

    public function tasks()
    {
        return $this->HasMany(Task::class);
    }
}
