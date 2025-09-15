@props(['title' => '', 'icon' => 'camera'])
<div class="rounded-lg border border-violet-300 dark:border-zinc-700 bg-violet-50 dark:bg-zinc-900 p-4">
    <div class="flex items-start gap-3">
        <div class="text-violet-500 mt-1">
            <x-dynamic-component
                :component="'heroicon-o-' . $icon"
                class="size-5"
            />
        </div>
        <div>
            <h2 class="text-sm font-semibold text-violet-900 dark:text-white">{{$title}}</h2>
            <p class="mt-1 text-xs text-violet-800 dark:text-gray-50">
                {{$slot}}
            </p>
        </div>
    </div>
</div>
