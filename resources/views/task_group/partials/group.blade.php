<div class="w-9/12 l:w-4/12 overflow-y-auto xl:h-[40rem] border-white border-2 shadow-sm sm:rounded-lg mx-auto flex flex-col justify-between"
    style="background-color: {{ $group->color }};">
    <div class="p-6 text-gray-900">
        <div class="group-header flex justify-between items-center mb-6">
            <span class="material-symbols-outlined">{{ $group->icon }}</span>
            <h3 class="text-md text-center">{{ $group->name }}</h3>
            <x-main-dropdown>

                <x-slot name="trigger">
                    <button
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <div><span class="material-symbols-outlined">more_vert</span></div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('task-group.edit', $group->id)">
                        {{ __('Edit group') }}
                    </x-dropdown-link>
                </x-slot>

            </x-main-dropdown>
        </div>
        @if($group->incompleteTasks->isEmpty())
            {{ __("You don't have any tasks yet.") }}
        @else
            @foreach($group->incompleteTasks as $task)
                @include('task.partials.task', ['task' => $task])
            @endforeach
        @endif
    </div>
        @include ('task.partials.new-task', ['taskGroupId' => $group->id])
</div>