<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\TaskGroup;
use App\Models\Task;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Return TaskGroup relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<TaskGroup, $this>
     */
    public function taskGroups(): HasMany
    {
        return $this->HasMany(TaskGroup::class);
    }

    /**
     * Return Task relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Task, $this>
     */
    public function tasks(): HasMany
    {
        return $this->HasMany(Task::class);
    }

    /**
     * Return Task relationship where tasks have not been completed
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Task, $this>
     */
    public function incompleteTasks(): HasMany
    {
        return $this->tasks()->where('completed_at', null);
    }

    /**
     * Return Task relationship where tasks have been completed
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Task, $this>
     */
    public function completedTasks(): HasMany
    {
        return $this->tasks()->where('completed_at', '!=', 'NULL');
    }
}
