<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">

    <div class="w-full xl:h-[40rem] mx-auto sm:px-6 lg:px-8 flex gap-4 justify-center flex-col xl:flex-row items-center">
        @include('task.all', ['tasks' => $allTasks])
        
        @if($groups->isNotEmpty())
            @include('task_group.groups ', ['groups' => $groups])
        @endif

        @if($completedTasks->isNotEmpty())
            @include('task.completed', ['tasks' => $completedTasks])
        @endif
    </div>

    </div>
        <div class="mt-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include ('task.partials.new-task', ['groups' => $groups])
        </div>
    </div>
<script>
    $(function(){
        $('input[type="radio"]').on('click', function(){
            if($(this).is(':checked')){
                let tasks = $('[data-task="'+$(this).val()+'"]');
                let taskId = $(this).val();
                let url = $(this).data('href');

                $.ajax({
                    'headers': {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    'method': 'POST',
                    'url': url,
                    success: function(response)
                    {
                        tasks.hide('slow', function(){
                            tasks.remove()
                        });

                        $('div.completed-tasks').prepend(response);
                    }
                });
            }
        });
    });
        // $(function () {
        //     $('form#new-task').on('submit', function (e) {
        //         e.preventDefault();
        //         let form = $(this);
        //         $.ajax({
        //             'method': $(form).attr('method'),
        //             'url': $(form).attr('action'),
        //             'data': $(form).serializeArray(),

        //             success: function(response)
        //             {
        //                 $('div#create-task').replaceWith(response);
        //             },
        //             error: function(response)
        //             {
        //                 console.log(response);
        //             }
        //         });

        //     });
        // });
</script>
</x-app-layout>
