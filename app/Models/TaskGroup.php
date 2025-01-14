<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Task;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskGroup extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
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

    /**
     * Cast attribute to array
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
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

    /**
     * Return Task relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Task, $this>
     */
    public function tasks(): HasMany
    {
        return $this->HasMany(Task::class)->orderBy($this->order[0], $this->order[1]);
    }

    /**
     * Return Task relationship where tasks have not been completed
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Task, $this>
     */
    public function incompleteTasks(): HasMany
    {
        $tasks = $this->HasMany(Task::class)->where('completed_at', NULL);
        if($this->order[0] == 'deadline')
            $tasks->orderByRaw($this->order[0].' IS NULL');

        $tasks->orderBy($this->order[0], $this->order[1]);
        return $tasks;
    }
}
