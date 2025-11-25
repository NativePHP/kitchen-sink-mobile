<div class="space-y-6">
    <!-- Header with Gradient -->
    <div class="bg-gradient-to-br from-sky-500 to-blue-500 dark:from-sky-600 dark:to-blue-600 text-white border-0 pb-8 pt-[var(--inset-top)] px-6">
        <div class="space-y-3">
            <div class="flex items-start gap-4">
                <div class="space-y-3">
                    <h1 class="text-white text-3xl font-bold flex items-center space-x-6 pt-2">
                        Browser
                    </h1>
                    <p class="text-lg text-white">
                        Seamlessly browse the web with multiple browser options tailored to your needs!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area with Horizontal Padding -->
    <div class="space-y-4 px-4">
        <!-- In-App Browser Card -->
        <flux:card class="bg-gradient-to-br from-slate-100 to-gray-100 dark:from-slate-800 dark:to-gray-900 border-2 border-sky-200 dark:border-sky-800">
            <flux:heading size="base" icon="window" class="text-sky-900 dark:text-sky-100 mb-2">
                In-App Browser
            </flux:heading>
            <flux:text class="mb-4 text-sky-700 dark:text-sky-300 font-medium">
                Opens URLs in an embedded browser within your app. Uses Custom Tabs on Android and SFSafariViewController on iOS. Perfect for keeping users within your app experience while browsing external content.
            </flux:text>
            <flux:button
                wire:click="openInApp"
                icon="globe-alt"
                class="py-4 w-full bg-gradient-to-br from-sky-500 to-blue-500 !text-white border-0 shadow-lg transition-all text-lg font-semibold [&>span]:!text-white"
            >
                Open in In-App Browser
            </flux:button>
        </flux:card>

        <!-- System Browser Card -->
        <flux:card class="bg-gradient-to-br from-slate-100 to-gray-100 dark:from-slate-800 dark:to-gray-900 border-2 border-blue-200 dark:border-blue-800">
            <flux:heading size="base" icon="arrow-top-right-on-square" class="text-blue-900 dark:text-blue-100 mb-2">
                System Browser
            </flux:heading>
            <flux:text class="mb-4 text-blue-700 dark:text-blue-300 font-medium">
                Opens URLs in the device's default browser app. This completely leaves your app and switches to the external browser. Useful when you want users to have the full browser experience or when the content requires it.
            </flux:text>
            <flux:button
                wire:click="openSystem"
                icon="arrow-top-right-on-square"
                class="py-4 w-full bg-gradient-to-br from-blue-500 to-indigo-500 !text-white border-0 shadow-lg transition-all text-lg font-semibold [&>span]:!text-white"
            >
                Open in System Browser
            </flux:button>
        </flux:card>

        <x-quote :quote="$this->randomQuote['quote']" :author="$this->randomQuote['author']" />

        <div class="pb-32"></div>
    </div>
</div>
