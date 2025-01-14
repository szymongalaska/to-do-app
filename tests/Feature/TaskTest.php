<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\TaskGroup;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;


    public function test_dashboard(): void
    {
        $user = User::factory()->has(TaskGroup::factory()->count(3)->has(Task::factory()->count(5)))->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200)
        ->assertViewHasAll(['allTasks', 'groups', 'completedTasks', 'sortOrders']);
    }


    public function test_complete(): void
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['completed_at' => null]);

        $response = $this->actingAs($user)->post(route('task.complete', $task));

        $response->assertViewHas('task')->assertStatus(200); 
        
        $task = Task::find($task->id);
        $this->assertInstanceOf(\Carbon\Carbon::class, $task->completed_at);
    }


    public function test_store_successfuly_saves()
    {
        $user = User::factory()->has(TaskGroup::factory())->create();

        $data = [
            'task' => fake()->text(15),
            'deadline' => now()->addDay()->toDateTimeString(),
            'task_group_id' => $user->taskGroups()->first()->id,
        ];

        $response = $this->actingAs($user)->post(route('task.store'), $data);

        $response->assertJson(['success' => true]);
        $this->assertDatabaseHas('tasks', ['task' => $data['task'], 'user_id' => $user->id, 'task_group_id' => $user->taskGroups()->first()->id]);
    }

    public function test_store_validation_fails()
    {
        $user = User::factory()->has(TaskGroup::factory())->create();

        $data = [
            'deadline' => fake()->randomNumber(5),
            'task_group_id' => 999999999,
        ];

        $response =  $this->actingAs($user)->post(route('task.store'), $data);
        $response->assertSessionHasErrors(['task', 'deadline', 'task_group_id'], null, 'taskErrors');
    }
}
