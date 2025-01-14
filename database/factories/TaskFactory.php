<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\TaskGroup;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
 /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'task' => fake()->text(15),
            'user_id' => User::factory(),
            'task_group_id' => TaskGroup::factory(),
            'deadline' =>   random_int(0,1) ? null : fake()->dateTime(),
            'completed_at' => random_int(0,1) ? null : fake()->dateTime(),
        ];
    }
}
