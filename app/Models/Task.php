<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\TaskGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'task',
        'user_id',
        'task_group_id',
        'deadline',
        'completed_at'
    ];

    /**
     * The attributes that are appended
     * 
     * @var list<string>
     */
    protected $appends = [
        'is_completed',
        'is_near_deadline'
    ];

    /**
     * Return TaskGroup relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<TaskGroup, $this>
     */
    public function taskGroup(): BelongsToMany
    {
        return $this->belongsToMany(TaskGroup::class);
    }

    /**
     * Set value of `is_completed` appended attribute
     * @return bool
     */
    protected function getIsCompletedAttribute(): bool
    {
        return $this->completed_at !== null;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'completed_at' => 'datetime',
            'deadline' => 'datetime'
        ];
    }

    /**
     * Set value of `is_near_deadline` appended attribute
     * @return bool
     */
    protected function getIsNearDeadlineAttribute(): bool
    {
        $date = new Carbon($this->deadline);
        return $date->diffInDays(Carbon::now(), true) <= 3 ? true : false;
    }
}
