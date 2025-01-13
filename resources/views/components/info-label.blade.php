@props(['icon', 'hidden' => false])

@php
    $icon ??= null;
@endphp

<div class="{{$hidden ? 'hidden ': ''}}max-w-lg flex flex-col items-center p-6 text-gray-300 mx-auto gap-2 info">
    @if($icon)<span class="material-symbols-outlined text-7xl">{{ $icon }}</span>@endif
    {{ $slot }}
</div>