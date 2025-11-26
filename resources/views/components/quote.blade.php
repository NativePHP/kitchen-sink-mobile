@props(['quote', 'author', 'lightmode' => false])

<div {{ $attributes->merge(['class' => 'relative rounded-xl border  bg-gradient-to-br from-slate-50 to-zinc-100 p-6 shadow-sm' . ($lightmode ? '' : ' dark:border-slate-700 dark:from-slate-900 dark:to-zinc-900')]) }}>
    <div class="flex flex-col gap-4">
        <flux:icon.quote class="size-8 text-slate-400 . {{$lightmode ? '' : ' dark:text-slate-600'}}"  />
        <blockquote class="text-lg leading-relaxed text-slate-700 italic {{$lightmode ? '' : 'dark:text-slate-300'}}">
            "{{ $quote }}"
        </blockquote>
        <footer class="text-sm font-medium text-slate-600 {{$lightmode ? '' : 'dark:text-slate-400'}}">
            — {{ $author }}
        </footer>
    </div>
</div>
