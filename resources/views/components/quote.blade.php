@props(['quote', 'author'])

<div {{ $attributes->merge(['class' => 'relative rounded-xl border dark:border-slate-700 bg-gradient-to-br from-slate-50 to-zinc-100 dark:from-slate-900 dark:to-zinc-900 p-6 shadow-sm']) }}>
    <div class="flex flex-col gap-4">
        <flux:icon.quote class="size-8 text-slate-400 dark:text-slate-600" />
        <blockquote class="text-lg leading-relaxed text-slate-700 dark:text-slate-300 italic">
            "{{ $quote }}"
        </blockquote>
        <footer class="text-sm font-medium text-slate-600 dark:text-slate-400">
            — {{ $author }}
        </footer>
    </div>
</div>
