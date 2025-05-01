@props(['class' => ''])

<div {{ $attributes->merge(['class' => "rounded-xl bg-white dark:bg-zinc-900 p-6 shadow-sm border border-zinc-200 dark:border-zinc-700 {$class}"]) }}>
    {{ $slot }}
</div>
