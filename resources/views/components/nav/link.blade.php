@props([
    'route' => null,
    'href' => null,
    'icon' => null,
])

@php
    $isActive = $route && request()->routeIs($route);
    $link = $href ?? ($route ? route($route) : '#');
    $iconClass = 'size-4 shrink-0';
@endphp

<a href="{{ $link }}"
   class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-semibold transition
          {{ $isActive ? 'bg-violet-400 text-white' : 'text-black  dark:text-white' }}">
    @if ($icon)
        <x-dynamic-component :component="'heroicon-o-' . $icon" class="{{ $iconClass }}" />
    @endif
    {{ $slot }}
</a>
