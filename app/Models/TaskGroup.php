<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Task;
use Illuminate\Database\Eloquent\Casts\Attribute;

class TaskGroup extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'color',
        'icon',
        'order'
    ];


    public const ORDERS = 
    [
        'Newest' => 'created_at.desc',
        'Oldest' => 'created_at.asc',
        'Deadline' => 'deadline',
        'Alphabetically' => 'task',
    ];

    protected function order(): Attribute
    {
        return Attribute::make(
            get: function(string $value){ 
                $order = explode('.', $value);

                if(!isset($order[1]))
                    $order = [$value, 'asc'];

                return $order;
            }
        );
    }

    public function tasks()
    {
        return $this->HasMany(Task::class)->orderBy($this->order[0], $this->order[1]);
    }

    public function incompleteTasks()
    {
        $tasks = $this->HasMany(Task::class)->where('completed_at', NULL);
        if($this->order[0] == 'deadline')
            $tasks->orderByRaw($this->order[0].' IS NULL');

        $tasks->orderBy($this->order[0], $this->order[1]);
        return $tasks;
    }
}
