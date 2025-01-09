<div class="w-full mx-auto sm:px-6 lg:px-8 my-2">
    <div class="bg-white overflow-hidden border-gray-200 border-2 sm:rounded-lg">
        <div class="p-4 text-gray-900 flex items-center justify-between text-sm">
            <div class="flex gap-4">
                {{ Str::limit($task->task, 240) }}
            </div>
            @if($task->deadline)
            <div class="w-3/12 task-deadline-wrapper flex items-center justify-center gap-2 text-xs">
                <span class="material-symbols-outlined text-md">event_available</span>
                {{ $task->completed_at }}
            </div>
            @endif
        </div>
    </div>
</div>