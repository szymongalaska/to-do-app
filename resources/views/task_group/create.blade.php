@php
    $icons = [['name' => 'star', 'color' => 'cyan-600'], ['name' => 'flag', 'color' => 'emerald-400'], ['name' => 'sunny', 'color' => 'yellow-300']]
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New group') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow rounded-lg">
                <form method="POST" action=" {{ route('task-group.store') }}" class="mt-6 space-y-6">
                    @csrf
                    <div class="flex flex-row items-center justify-center gap-4">
                        <div class="w-5/12 h-16 flex flex-col justify-between">
                            <x-input-label for="name" :value="__('Name of group')" />
                            <input
                                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block"
                                type="text" required name="name">
                        </div>
                        <div class="w-8 h-16 flex flex-col justify-between">
                            <x-input-label for="color" :value="__('Color')" />
                            <x-color-picker name="color" :options="['default' => '#A0AEC0', 'theme' => 'classic', 'components' => ['opacity' => true, 'hue' => true, 'interaction' => ['input' => true, 'hex' => true, 'cancel' => true, 'save' => true]]]"></x-color-picker>
                        </div>
                        <div class="w-3/12 lg:2/12 h-16 flex flex-col justify-between">
                            <x-input-label for="icon" :value="__('Icon')" />
                            <select name="icon"
                                class="material-symbols-outlined border-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block">
                                @foreach($icons as $icon)
                                    <option value="{{ $icon['name'] }}"
                                        class="text-{{ $icon['color'] }} material-symbols-outlined">{{ $icon['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if($errors->taskGroupErrors->any())
                        <div>
                            @foreach ($errors->taskGroupErrors->all() as $error)
                                <x-input-error :messages="$error" class="mt-2" />
                            @endforeach
                        </div>
                    @endif
                    <div class="flex justify-end items-center gap-4">
                        <x-primary-button>{{ __('Submit') }}</x-primary-button>


                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('select').on('change', function () {
            cls = $('option:selected').attr('class').split(' ').find(cls => cls.startsWith('text-'));
            $('select').removeClass($('select').attr('class').split(' ').find(cls => cls.startsWith('text-'))).addClass(cls);
        });
    </script>
</x-app-layout>