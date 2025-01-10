<div class="flex items-center w-11/12 mx-auto mb-6 flex-col">
    <form method="POST" action=" {{ route('task.store') }}" class="space-y-6 w-full new-task-form">
        @csrf
            <div class="w-full flex items-center bg-white shadow justify-between px-2 py-2 rounded-lg">
                <button class="material-symbols-outlined">add</button>
                <input required
                    class="border-0 ring-0 focus:ring-0 rounded-md block w-full"
                    type="text" name="task">
                <input class="invisible w-1"
                    type="datetime-local" name="deadline">
                <span class="border-none focus:ring-0 block w-2/12 float-right material-symbols-outlined cursor-pointer date-picker">date_range</s>
            </div>

            @if($taskGroupId)
                <input type="hidden" name="task_group_id" value="{{ $taskGroupId }}">
            @endif
    </form>
</div>
