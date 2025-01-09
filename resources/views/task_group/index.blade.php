<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task groups') }}
        </h2>
    </x-slot>
    <div class="py-12 flex flex-col xl:flex-row w-full gap-2">
        <div class="max-w-sm sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-gray-600 shadow sm:rounded-lg">
                <ul class="text-gray-200">
                @foreach($groups as $group)
                    <li class="p-6 border-b border-white my-2 @if ($selectedGroup && $group->id == $selectedGroup->id) text-black bg-white sm:rounded-lg @endif"><a class="flex item-center gap-2" href="{{ route('task-group.index',['group' => $group]) }}"><span class="material-symbols-outlined">{{ $group->icon}}</span> {{ $group->name }}</a></li>
                @endforeach
                </ul>
            </div>
        </div>
        @if($selectedGroup)
            @include('task_group.partials.group', ['group' => $selectedGroup])
        @endif
    </div>
</x-app-layout>