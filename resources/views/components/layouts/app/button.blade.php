@props(['title' => '', 'icon' => ''])

<button
    {{ $attributes->merge(['type' => 'button']) }}
    class="relative inline-flex items-center justify-center w-full gap-2 rounded-md bg-violet-400 px-4 py-2 text-sm font-semibold text-white hover:bg-violet-600 transition">
   <div class="flex items-center">
       <x-dynamic-component wire:loading.remove :component="'heroicon-o-' . $icon" class="size-4 mr-2" />
       <span wire:loading.remove>{{ $title }}</span>
   </div>
    <div wire:loading class=" inset-0 flex items-center justify-center " >
        <svg  class="shrink-0 size-4 animate-spin" data-flux-icon="" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true" data-slot="icon">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </div>
</button>
