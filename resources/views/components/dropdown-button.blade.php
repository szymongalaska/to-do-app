@php
$lang = app()->getLocale() === $lang;
$class = $lang ? 'text-gray-200 ' : 'hover:bg-gray-100 text-gray-700 ';

@endphp
<button {{ $attributes->class([$class.'block w-full px-4 py-2 text-start text-sm leading-5 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out'])->merge(['disabled' => $lang]) }}>
{{ $slot }}
</button>
