<div class="space-y-6">
    <!-- Header with Gradient -->
    <div class="bg-gradient-to-br from-yellow-500 to-orange-500 dark:from-yellow-600 dark:to-orange-600 text-white border-0 pb-8 pt-[var(--inset-top)] px-6">
        <div class="space-y-3">
            <div class="flex items-start gap-4">
                <div class="space-y-3">
                    <h1 class="text-white text-3xl font-bold flex items-center space-x-6 pt-2">
                        Toast
                    </h1>
                    <p class="text-lg text-white">
                        Pop up quick messages with style! Create custom toast notifications!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area with Horizontal Padding -->
    <div class="space-y-4 px-4">
        <flux:card class="bg-gradient-to-br from-slate-100 to-gray-100 dark:from-slate-800 dark:to-gray-900 border-2 border-yellow-200 dark:border-yellow-800">
            <div class="space-y-4">
                <flux:input wire:model="message" label="Message" placeholder="Type a message" />

                <flux:button
                    wire:click="toast"
                    icon="chat-bubble-bottom-center-text"
                    class="py-6 w-full bg-gradient-to-br from-yellow-500 to-orange-500 !text-white border-0 shadow-lg transition-all text-xl font-semibold [&>span]:!text-white"
                >
                    Show Toast
                </flux:button>
            </div>
        </flux:card>
        <div class="pb-32"></div>
    </div>
</div>
