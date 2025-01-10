$(function () {
    $(document).on('submit', 'div.task-group', function (e) {
        e.preventDefault();
        let form = $(this).find('form.new-task-form');
        $.ajax({
            'method': $(form).attr('method'),
            'url': $(form).attr('action'),
            'data': $(form).serializeArray(),

            beforeSend: function () {
                $(form).find('button').html('progress_activity').addClass('animate-spin');
            },

            success: function (response) {
                $(form).trigger('reset');

                $(form).find('button').html('check').removeClass('animate-spin').addClass('text-green-600');

                let task = $(response.view).hide();
                $('div.tasks[data-group-id="all"]').prepend(task);

                if (response.task_group_id) {
                    let task2 = $(task).clone();
                    $('div.tasks[data-group-id="' + response.task_group_id + '"]').prepend(task2);
                    task2.show('slow');
                }

                task.show('slow');

                setTimeout(function () {
                    $(form).find('button').removeClass('text-green-600').html('add');
                }, 1500);
            },
            error: function (response) {
                var ul = $('<ul class="text-sm text-red-600 space-y-1 mt-2"></ul>');

                let errors = response.responseJSON.errors
                errors = Object.values(errors);
                $(errors).each(function (field, errorMessages) {
                    $(errorMessages).each(function () {
                        let element = '<li>' + this + '</li>';
                        $(ul).append(element);
                    });
                });
                $(form).parent().append(ul);
                setTimeout(function () {
                    $(ul).hide('slow', function () { $(ul).remove() });
                }, 3000);
            }
        });
    });

    $(document).on('click', 'a.sort-link', function(e){
        e.preventDefault();

        let value = $(this).data('order');
        let url = $(this).attr('href');
        let taskGroup = $(this).parentsUntil('div.task-group').parent();

        $.ajax({
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'method': 'PATCH',
            'url': url,
            'data': {'order': value},

            beforeSend: function(){

            },
            
            success: function(response){
                $(taskGroup).replaceWith(response);
            }
        })
    });
});