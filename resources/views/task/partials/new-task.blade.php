<div class="flex items-center w-11/12 mx-auto mb-6">
    <form id="new-task" method="POST" action=" {{ route('task.store') }}" class="space-y-6 w-full">
        @csrf
            <div class="w-full flex items-center bg-white shadow justify-between px-2 py-2 sm:rounded-lg">
                <button class="material-symbols-outlined">add</button>
                <input required
                    class="border-0 ring-0 focus:ring-0 rounded-md block w-full"
                    type="text" name="task">
                <input class="border-none focus:ring-0 block w-2/12 float-right"
                    type="datetime-local" name="deadline">
                @foreach ($errors->taskErrors->all() as $error)
                    <x-input-error :messages="$error" class="mt-2" />
                @endforeach
            </div>

            @if($taskGroupId)
                <input type="hidden" name="task_group_id" value="{{ $taskGroupId }}">
            @endif
    </form>
</div>