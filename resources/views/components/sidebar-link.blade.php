@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center py-2 px-4 text-white bg-gray-700 bg-opacity-50 rounded transition duration-200'
            : 'flex items-center py-2 px-4 text-gray-300 hover:bg-gray-700 hover:text-white rounded transition duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
