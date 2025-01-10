<div class="w-full mx-auto sm:px-6 lg:px-8 my-2" data-task="{{ $task->id }}">
    <div class="bg-white overflow-hidden border-gray-200 border-2 rounded-lg">
        <div class="p-4 text-gray-900 flex items-center justify-between text-sm">
            <div class="flex gap-4">
                <input type="radio" class="w-5 h-5 focus:ring-green-500 text-green-500" value="{{ $task->id }}" data-href="{{ route('task.complete', $task) }}" onClick="completeTask(this)">
                {{ Str::limit($task->task, 240) }}
            </div>
            @if($task->deadline)
            <div class="w-3/12 task-deadline-wrapper flex items-center justify-center gap-2 text-xs @if($task->is_near_deadline)text-red-600 font-semibold @endif">
                <span class="material-symbols-outlined text-md">calendar_month</span>
                {{ $task->deadline }}
            </div>
            @endif
        </div>
    </div>
</div>