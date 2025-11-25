<div class="space-y-6">
    <!-- Header with Gradient -->
    <div class="bg-gradient-to-br from-blue-500 to-cyan-500 dark:from-blue-600 dark:to-cyan-600 text-white border-0 pb-8 pt-[var(--inset-top)] px-6">
        <div class="space-y-3">
            <div class="flex items-start gap-4">
                <div class="space-y-3">
                    <h1 class="text-white text-3xl font-bold flex items-center space-x-6 pt-2">
                        Camera
                    </h1>
                    <p class="text-lg text-white">
                        Capture stunning photos with your device camera and unleash your creativity!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area with Horizontal Padding -->
    <div class="space-y-4 px-4">
        <!-- Camera Button Card -->
        <flux:card class="bg-zinc-50 dark:bg-zinc-800/50">
            <flux:button
                wire:click="camera"
                icon="camera"
                class="py-6 w-full bg-gradient-to-br from-blue-500 to-cyan-500 !text-white border-0 shadow-lg transition-all text-xl font-semibold [&>span]:!text-white"
            >
                Take a Photo
            </flux:button>
        </flux:card>

        <!-- Photo Display Card -->
        @if ($photoDataUrl)
            <flux:card class="bg-gradient-to-br from-amber-100 to-yellow-100 dark:from-amber-900/30 dark:to-yellow-900/30 border-2 border-amber-200 dark:border-amber-700 overflow-hidden">
                <flux:heading icon="camera" class="text-amber-900 dark:text-amber-100 mb-4">
                    Your Amazing Photo
                </flux:heading>
                <img src="{{ $photoDataUrl }}" class="w-full rounded-lg shadow-2xl border-2 border-white/50" alt="Captured photo" />
            </flux:card>
        @endif

        <x-quote :quote="$this->randomQuote['quote']" :author="$this->randomQuote['author']" />
    </div>
    <div class="pb-32"></div>
</div>

