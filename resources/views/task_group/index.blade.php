<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task groups') }}
        </h2>
    </x-slot>
    <div class="py-12 flex flex-col xl:flex-row w-full gap-2">
        @if($groups->isNotEmpty())
            <div class="w-11/12 xl:max-w-sm sm:px-6 lg:px-8 space-y-6 mx-auto xl:mx-0">
                <div class="p-4 sm:p-8 bg-gray-600 shadow rounded-lg">
                    <ul class="text-gray-200" id="task_group_links">
                        @foreach($groups as $group)
                            <li class="p-6 border-b border-white my-2"><a class="flex item-center gap-2"
                                    href="{{ route('task-group.show', $group) }}"><span
                                        class="material-symbols-outlined">{{ $group->icon}}</span> {{ $group->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div id="task-group" class="w-full xl:w-9/12 mx-auto">
            </div>
        @else
            <x-info-label>{{__("You don't have any groups.")}}</x-info-label>
        @endif
        </div>
</x-app-layout>
<script>
    $(function () {
        $('ul#task_group_links a').on('click', function (event) {
            $('ul#task_group_links li').each(function () {
                $(this).removeClass('text-black bg-white rounded-lg');
            });
            event.preventDefault();
            let url = $(this).attr('href');
            let li = $(this).parent();

            $.ajax({
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'method': 'GET',
                'url': url,
                success: function (response) {

                    $('div#task-group').hide('fast', function () { $(this).html(response) }).show('fast');
                    $(li).addClass('text-black bg-white rounded-lg');
                },
            });
        });
    });
</script>