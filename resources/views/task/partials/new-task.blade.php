<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" id="create-task">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3>{{ __('Create task') }}</h3>
                <form id="new-task" method="POST" action=" {{ route('task.store') }}" class="mt-6 space-y-6">
                    @csrf
                    <div>
                        <div class="w-full flex items-center justify-end">
                            <input required class="border-gray-300 focus:ring-indigo-500 rounded-md shadow-sm mt-1 py-4 pr-96 block w-full" type="text" name="task">
                            <input class="border-none focus:ring-0 block w-2/12 float-right absolute mt-1 mx-2" type="datetime-local" name="deadline">
                        </div>
                        @foreach ($errors->taskErrors->all() as $error)
                            <x-input-error :messages="$error" class="mt-2" />
                        @endforeach
                    </div>

                    @if($groups->isNotEmpty())
                    <div>
                        <x-input-label for="task_group_id" :value="__('Assign task to group')"></x-input-label>
                        <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" name="task_group_id">
                            <option value="null">{{ __("Do not assign to any group") }}</option>
                            @foreach ($groups as $taskGroup)
                            <option value="{{ $taskGroup->id }}">{{ $taskGroup->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Submit') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>