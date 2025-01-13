<div class="w-11/12 l:w-4/12 mx-auto h-[40rem] bg-white shadow-sm rounded-lg flex flex-col justify-between task-group">
    <div>
    <div class="group-header p-6 pb-0 text-gray-900 border-gray-300 border-b">
        <h3 class="text-md text-center mb-6">{{ __('All tasks') }}</h3>
    </div>
    <div class="p-6 text-gray-900 overflow-y-auto">
        <div class="tasks" data-group-id="all">
                <x-info-label :hidden="!$tasks->isEmpty()" icon="check_circle">{{__("You don't have any tasks yet.")}}</x-info-label>
                @foreach($tasks as $task)
                    @include('task.partials.task', ['task' => $task])
                @endforeach
        </div>
    </div>
    </div>
    @include ('task.partials.new-task', ['taskGroupId' => null])
</div>