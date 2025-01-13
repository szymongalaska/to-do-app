import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.completeTask = function(element) {
    if ($(element).is(':checked')) {
        let tasks = $('[data-task="' + $(element).val() + '"]');
        let group = $(element).closest('div.tasks');
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
                
                if($(group).children().length == 2)
                    $(group).find('div.info').css('opacity', '0').css('display', 'flex').animate({opacity: 1}, 'slow');

                if($('div.tasks[data-group-id="all"]').children().length == 2)
                    $('div.tasks[data-group-id="all"]').find('div.info').css('opacity', '0').css('display', 'flex').animate({opacity: 1}, 'slow');

                $('div.completed-tasks').find('div.info').remove();
                $('div.completed-tasks').prepend(response);
            }
        });
    }
};