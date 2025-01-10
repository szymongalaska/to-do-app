import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.completeTask = function(element) {
    if ($(element).is(':checked')) {
        let tasks = $('[data-task="' + $(element).val() + '"]');
        let taskId = $(element).val();
        let url = $(element).data('href');

        $.ajax({
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'method': 'POST',
            'url': url,
            success: function (response) {
                tasks.hide('slow', function () {
                    tasks.remove()
                });

                $('div.completed-tasks').prepend(response);
            }
        });
    }
};