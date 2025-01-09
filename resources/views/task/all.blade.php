<div class="w-11/12 xl:w-4/12 overflow-y-auto xl:h-[40rem] bg-white shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <div class="group-header">
            <h3 class="text-md text-center mb-6">{{ __('All tasks') }}</h3>
        </div>
        @if($tasks->isEmpty())
            {{ __("You don't have any tasks yet.") }}
        @else
            @foreach($tasks as $task)
                @include('task.partials.task', ['task' => $task])
            @endforeach
        @endif
    </div>
</div>