<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskGroup>
 */
class TaskGroupFactory extends Factory
{
 /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->text(15),
            'user_id' => User::factory(),
            'color' => fake()->hexColor(),
            'icon' => 'sunny',
            'order' => 'created_at.desc',
        ];
    }
}