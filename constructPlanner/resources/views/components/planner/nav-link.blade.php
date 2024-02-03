@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center p-2 rounded-lg text-gray-900 bg-gray-200 group'
            : 'flex items-center p-2 rounded-lg text-white hover:bg-gray-100 dark:hover:bg-gray-700 group';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
