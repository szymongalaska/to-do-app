<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskGroupController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('login');
});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/tasks', [TaskController::class, 'dashboard'])->name('tasks');
    Route::resource('/task', TaskController::class);
    Route::resource('/task-group', TaskGroupController::class);
    Route::post('/task/{task}/complete', [TaskController::class, 'complete'])->name('task.complete');
    Route::patch('/task-group/{task_group}/update-order', [TaskGroupController::class, 'updateOrder'])->name('task-group.update-order');
});

// Route::midcdleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
