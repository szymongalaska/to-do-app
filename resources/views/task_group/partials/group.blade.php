@php
    $currentOrder = implode('.', $group->order);
    $sortOrders ??= null;
@endphp

<div class="w-11/12 l:w-4/12 h-16 h-[40rem] border-white border-2 shadow-sm rounded-lg mx-auto flex flex-col justify-between task-group"
    style="background-color: {{ $group->color }};">
    <div>
    <div class="group-header flex justify-between items-center mb-6 p-6 pb-0 text-gray-900 border-gray-300 border-b">
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
                    @if($sortOrders)
                    <div class="font-medium text-sm text-base text-gray-400 ml-2 mt-2">{{ __('Sort') }}</div>

                    @foreach($sortOrders as $label => $order)
                    <x-dropdown-link class="sort-link @if($currentOrder === $order) text-gray-800 @endif" data-order="{{ $order }}"
                        :href="route('task-group.update-order', $group)">
                        {{ __($label) }}
                    </x-dropdown-link>
                    @endforeach

                    @endif
                </x-slot>

            </x-main-dropdown>
        </div>
    <div class="p-6 text-gray-900 overflow-y-auto">
        <div class="tasks" data-group-id="{{$group->id}}">
                <x-info-label :hidden="!$group->incompleteTasks->isEmpty()" icon="check_circle">{{ __("You don't have any tasks yet.") }}</x-info-label>
                @foreach($group->incompleteTasks as $task)
                    @include('task.partials.task', ['task' => $task])
                @endforeach
        </div>
    </div>
    </div>
    @include ('task.partials.new-task', ['taskGroupId' => $group->id])
</div>