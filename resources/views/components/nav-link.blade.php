@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-yellow-300 dark:border-yellow-300 text-sm font-medium leading-5 text-red-900 dark:text-red-100 focus:outline-none focus:border-yellow-300 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-red-500 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 hover:border-yellow-300 dark:hover:border-yellow-300 focus:outline-none focus:text-red-700 dark:focus:text-red-300 focus:border-red-300 dark:focus:border-red-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
