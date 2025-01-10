<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('To do') }}
        </h2>
    </x-slot>

    <div class="py-12">

    <div class="w-full xl:h-[40rem] mx-auto sm:px-6 lg:px-8 flex gap-4 justify-center flex-col xl:flex-row items-center">
        @include('task_group.all', ['tasks' => $allTasks])
        
        @if($groups->isNotEmpty())
            @foreach($groups as $group)
                @if($group->incompleteTasks->isNotEmpty())
                    @include('task_group.partials.group ', [$group, $sortOrders])
                @endif
            @endforeach
        @endif

        @if($completedTasks->isNotEmpty())
            @include('task_group.completed', ['tasks' => $completedTasks])
        @endif
    </div>

    </div>
    </div>
</x-app-layout>
