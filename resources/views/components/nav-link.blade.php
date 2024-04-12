@props(['active'])

@php
$defaultClasses = 'inline-flex items-center px-4 py-2 border-b-2 text-sm font-medium focus:outline-none transition duration-150 ease-in-out block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100';
$activeClasses = 'border-indigo-500 text-indigo-600 focus:border-indigo-700 hover:text-indigo-900 hover:border-indigo-700 block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100';
$inactiveClasses = 'border-transparent text-gray-600 hover:text-gray-900 hover:border-gray-300 focus:text-gray-900 focus:border-gray-300 block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100';

$classes = ($active ?? false) ? "$defaultClasses $activeClasses" : "$defaultClasses $inactiveClasses";
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

