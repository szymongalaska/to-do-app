<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\TaskGroup;
use App\Models\Task;

class TaskGroupTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_index_with_no_query(): void
    {
        $user = User::factory()->has(TaskGroup::factory()->count(3))->create();
        $response = $this->actingAs($user)->get(route('task-group.index'));

        $response->assertStatus(200)->assertViewHasAll(['groups' => $user->taskGroups()->get(), 'selectedGroup' => null]);
    }

    public function test_index_with_query(): void
    {
        $user = User::factory()->has(TaskGroup::factory()->count(3))->create();
        $response = $this->actingAs($user)->get(route('task-group.index', ['group' => $user->taskGroups()->first()->id]));

        $response->assertStatus(200)->assertViewHasAll(['groups' => $user->taskGroups()->get(), 'selectedGroup' => $user->taskGroups()->first()]);
    }

    public function test_create(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('task-group.create'));
        $response->assertStatus(200)->assertViewIs('task_group.create');
    }

    public function test_store_successfuly_saves(): void
    {
        $user = User::factory()->create();
        $data = [
            'name' => fake()->text(15),
            'color' => fake()->hexColor(),
            'icon' => 'sunny',
        ];

        $response = $this->actingAs($user)->post(route('task-group.store'), $data);

        $response->assertRedirectToRoute('task-group.index');
        $this->assertDatabaseHas('task_groups', ['name' => $data['name'], 'color' => $data['color'], 'icon' => $data['icon'], 'user_id' => $user->id]);
    }

    public function test_store_validation_fails(): void
    {
        $user = User::factory()->create();
        $data = [
            'color' => fake()->randomNumber(5),
            'icon' => fake()->randomNumber(9),
        ];

        $response = $this->actingAs($user)->post(route('task-group.store'), $data);
        $response->assertSessionHasErrorsIn('taskGroupErrors', ['name', 'color', 'icon']);
    }

    public function test_show_no_ajax(): void
    {
        $user = User::factory()->has(TaskGroup::factory()->count(2)->has(Task::factory()->count(5)))->create();

        $response = $this->actingAs($user)->get(route('task-group.show', 'all'));
        $response->assertStatus(200)->assertViewIs('task_group.show')->assertViewHas('group');
    }

    public function test_show_one_group()
    {
        $user = User::factory()->has(TaskGroup::factory()->count(2)->has(Task::factory()->count(5)))->create();

        $response = $this->actingAs($user)->withHeader('X-Requested-With', 'XMLHttpRequest')
            ->get(route('task-group.show', $user->taskGroups()->first()->id));

        $response->assertStatus(200)->assertViewIs('task_group.partials.group')->assertViewHas('group', $user->taskGroups()->first());
    }

    public function test_show_all_tasks()
    {
        $user = User::factory()->has(TaskGroup::factory()->count(2)->has(Task::factory()->count(5)))->create();

        $response = $this->actingAs($user)->withHeader('X-Requested-With', 'XMLHttpRequest')
            ->get(route('task-group.show', 'all'));

        $response->assertStatus(200)->assertViewIs('task_group.all')->assertViewHas('tasks', $user->tasks()->get());
    }

    public function test_show_completed_tasks(): void
    {
        $user = User::factory()->has(TaskGroup::factory()->count(2)->has(Task::factory()->count(5)))->create();

        $response = $this->actingAs($user)->withHeader('X-Requested-With', 'XMLHttpRequest')
            ->get(route('task-group.show', 'completed'));

        $response->assertStatus(200)->assertViewIs('task_group.completed')->assertViewHas('tasks', $user->completedTasks()->get());
    }

    public function test_edit(): void
    {
        $user = User::factory()->has(TaskGroup::factory())->create();

        $response = $this->actingAs($user)->get(route('task-group.edit', $user->taskGroups()->first()->id));
        $response->assertStatus(200)->assertViewIs('task_group.edit')->assertViewHas('group', $user->taskGroups()->first());
    }

    public function test_update(): void
    {
        $user = User::factory()->has(TaskGroup::factory())->create();
        $data = [
            'name' => fake()->text(25),
            'color' => fake()->hexColor(),
            'icon' => 'flag'
        ];

        $response = $this->actingAs($user)->patch(route('task-group.update', $user->taskGroups()->first()->id), $data);

        $response->assertRedirectToRoute('tasks');
        $this->assertDatabaseHas('task_groups', ['user_id' => $user->id, 'name' => $data['name'], 'color' => $data['color'], 'icon' => 'flag']);
    }

    public function test_update_validation_fails(): void
    {
        $user = User::factory()->has(TaskGroup::factory())->create();
        $data = [
            'color' => fake()->randomNumber(5),
            'icon' => fake()->randomNumber(9),
        ];

        $response = $this->actingAs($user)->patch(route('task-group.update', $user->taskGroups()->first()->id), $data);

        $response->assertSessionHasErrorsIn('taskGroupErrors', ['name', 'color', 'icon']);
    }

    public function test_update_order(): void
    {
        $user = User::factory()->has(TaskGroup::factory())->create();
        $data = [
            'order' => 'deadline',
        ];

        $response = $this->actingAs($user)->patch(route('task-group.update-order', $user->taskGroups()->first()->id), $data);
        
        $response->assertStatus(200)->assertViewIs('task_group.partials.group')->assertViewHas('group', $user->taskGroups()->first());
        $this->assertDatabaseHas('task_groups', ['order' => 'deadline']);
    }

    public function test_update_order_validation_fails(): void
    {
        $user = User::factory()->has(TaskGroup::factory())->create();
        $data = [
            'order' => 'testOrder',
        ];

        $response = $this->actingAs($user)->patch(route('task-group.update-order', $user->taskGroups()->first()->id), $data);
        
        $response->assertSessionHasErrors(['order']);
    }
}
