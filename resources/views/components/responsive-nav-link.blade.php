@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-gaming-accent text-start text-base font-medium text-gaming-accent bg-gaming-accent/10 focus:outline-none focus:text-gaming-accent focus:bg-gaming-accent/20 focus:border-gaming-accent transition-all duration-200'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gaming-text hover:text-gaming-accent hover:bg-gaming-accent/10 hover:border-gaming-accent/50 focus:outline-none focus:text-gaming-accent focus:bg-gaming-accent/10 focus:border-gaming-accent/50 transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
