<div class="space-y-6">
    <!-- Header with Gradient -->
    <div class="bg-gradient-to-br from-green-500 to-emerald-500 dark:from-green-600 dark:to-emerald-600 text-white border-0 pb-8 pt-[var(--inset-top)] px-6">
        <div class="space-y-3">
            <div class="flex items-start gap-4">
                <div class="space-y-3">
                    <h1 class="text-white text-3xl font-bold flex items-center space-x-6 pt-2">
                        Geolocation
                    </h1>
                    <p class="text-lg text-white">
                        Pinpoint your location with GPS precision and explore the world around you!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area with Horizontal Padding -->
    <div class="space-y-4 px-4">
        <!-- Check Permissions Card -->
        <flux:card class="bg-zinc-50 dark:bg-zinc-800/50">
            <flux:button
                wire:click="checkPermissions"
                icon="shield-check"
                class="py-6 w-full bg-gradient-to-br from-green-500 to-emerald-500 !text-white border-0 shadow-lg transition-all text-xl font-semibold [&>span]:!text-white"
            >
                Check Permissions
            </flux:button>
        </flux:card>

        <!-- Request Permission Card -->
        <flux:card class="bg-zinc-50 dark:bg-zinc-800/50">
            <flux:button
                wire:click="requestPermission"
                icon="lock-open"
                class="py-6 w-full bg-gradient-to-br from-emerald-500 to-teal-500 !text-white border-0 shadow-lg transition-all text-xl font-semibold [&>span]:!text-white"
            >
                Request Permission
            </flux:button>
        </flux:card>

        <!-- Get Location Card -->
        <flux:card class="bg-zinc-50 dark:bg-zinc-800/50">
            <flux:button
                wire:click="getLocation"
                icon="map-pin"
                class="py-6 w-full bg-gradient-to-br from-teal-500 to-cyan-500 !text-white border-0 shadow-lg transition-all text-xl font-semibold [&>span]:!text-white"
            >
                Get Location
            </flux:button>
        </flux:card>

        @if($result)
            <flux:card class="bg-gradient-to-br from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 border-2 border-green-200 dark:border-green-700">
                <flux:heading icon="map" class="text-green-900 dark:text-green-100 mb-4">Result:</flux:heading>
                <div class="p-4 bg-white/50 dark:bg-gray-800/50 rounded-lg border-2 border-white/50 backdrop-blur-sm">
                    <p class="text-sm whitespace-pre-wrap font-mono font-semibold">{{ $result }}</p>
                </div>
            </flux:card>
        @endif

        <x-quote :quote="$this->randomQuote['quote']" :author="$this->randomQuote['author']" />
        <div class="pb-32"></div>
    </div>
</div>
