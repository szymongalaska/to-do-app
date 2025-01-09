<div class="w-9/12 l:w-4/12 mx-auto overflow-y-auto xl:h-[40rem] bg-white shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <div class="group-header">
            <h3 class="text-md text-center mb-6">{{ __('Completed tasks') }}</h3>
        </div>
        <div class="completed-tasks">
            @foreach($tasks as $task)
                @include('task.partials.completed-task', ['task' => $task])
            @endforeach
        </div>
    </div>
</div>