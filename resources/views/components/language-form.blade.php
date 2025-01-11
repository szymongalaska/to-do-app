<x-main-dropdown>
<x-slot name="trigger">
    <div class="flex justify-end items-center cursor-pointer text-xs text-gray-500">
    {{__('Language')}}
    <span class="material-symbols-outlined ml-1">language</span>
    </div>
</x-slot>
<x-slot name="content">
<form action="{{route('language.change')}}" method="POST">
    @csrf
    <input type="hidden" name="language" value="pl">
    <x-dropdown-button lang="pl">{{ __('Polish') }}</x-dropdown-button>
</form>
<form action="{{route('language.change')}}" method="POST">
    @csrf
    <input type="hidden" name="language" value="en">
    <x-dropdown-button lang="en">{{ __('English') }}</x-dropdown-button>
</form>
</x-slot>
</x-main-dropdown>