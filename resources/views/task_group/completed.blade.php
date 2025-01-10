<div class="w-11/12 l:w-4/12 mx-auto h-[40rem] bg-white shadow-sm rounded-lg flex flex-col justify-between">
    <div class="group-header p-6 pb-0 text-gray-900">
        <h3 class="text-md text-center mb-6">{{ __('Completed tasks') }}</h3>
    </div>
    <div class="p-6 text-gray-900 overflow-y-auto">
        <div class="completed-tasks">
            @if($tasks->isEmpty())
                <x-info-label>{{__("You haven't completed any tasks yet.")}}</x-info-label>
            @else

                @foreach($tasks as $task)
                    @include('task.partials.completed-task', ['task' => $task])
                @endforeach
            @endif
        </div>
    </div>
</div>