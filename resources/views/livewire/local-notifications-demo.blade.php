<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-br from-amber-500 to-orange-500 dark:from-amber-600 dark:to-orange-600 text-white border-0 pb-8 pt-[var(--inset-top)] px-6">
        <div class="space-y-3">
            <div class="flex items-start gap-4">
                <div class="space-y-3">
                    <h1 class="text-white text-3xl font-bold flex items-center space-x-6 pt-2">
                        Local Notifications
                    </h1>
                    <p class="text-lg text-white">
                        Immediate, scheduled, recurring, and action buttons with per-action URLs.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-4 px-4">

        <!-- Permission -->
        <flux:card>
            <flux:heading size="lg">Permission</flux:heading>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 mb-3">Request notification permission from the user.</p>
            <div class="space-y-2">
                <flux:button wire:click="requestPermission" icon="shield-check" variant="primary" class="w-full">
                    Request Permission
                </flux:button>
                @ios
                    <flux:button wire:click="clearBadge" icon="x-circle" class="w-full">
                        Clear Badge
                    </flux:button>
                @endios
            </div>
        </flux:card>

        <!-- Immediate Notifications -->
        <flux:card>
            <flux:heading size="lg">Immediate Notifications</flux:heading>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 mb-3">Show a notification right now.</p>
            <div class="space-y-2">
                <flux:button wire:click="showSimple" icon="bell" class="w-full">
                    Simple Notification
                </flux:button>
                <flux:button wire:click="showWithUrl" icon="arrow-top-right-on-square" class="w-full">
                    With URL (navigates to Haptics)
                </flux:button>
                <flux:button wire:click="showWithActions" icon="hand-raised" class="w-full">
                    With Action Buttons
                </flux:button>
                <flux:button wire:click="showSilent" icon="speaker-x-mark" class="w-full">
                    Silent (no sound/vibration)
                </flux:button>
            </div>
        </flux:card>

        <!-- Scheduled -->
        <flux:card>
            <flux:heading size="lg">Scheduled</flux:heading>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 mb-3">Schedule a notification for 10 seconds from now.</p>
            <flux:button wire:click="showScheduled" icon="clock" variant="primary" class="w-full">
                Schedule in 10 Seconds
            </flux:button>
        </flux:card>

        <!-- Runtime Recurring -->
        <flux:card>
            <flux:heading size="lg">Create a Reminder</flux:heading>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 mb-3">Set up a recurring notification with the OS. Survives app close and device reboot.</p>
            <div class="space-y-3 mt-3">
                <flux:input wire:model="reminderTitle" label="Title" placeholder="Practice Time" />
                <flux:input wire:model="reminderBody" label="Body" placeholder="Time for your session!" />
                <flux:input wire:model="reminderTime" label="Time" type="time" />
                <flux:select wire:model.live="reminderFrequency" label="Frequency">
                    <flux:select.option value="hourly">Hourly</flux:select.option>
                    <flux:select.option value="daily">Daily</flux:select.option>
                    <flux:select.option value="weekly">Weekly</flux:select.option>
                    <flux:select.option value="monthly">Monthly</flux:select.option>
                </flux:select>

                @if ($reminderFrequency === 'weekly')
                    <flux:select wire:model="reminderWeekday" label="Day of Week">
                        <flux:select.option value="0">Sunday</flux:select.option>
                        <flux:select.option value="1">Monday</flux:select.option>
                        <flux:select.option value="2">Tuesday</flux:select.option>
                        <flux:select.option value="3">Wednesday</flux:select.option>
                        <flux:select.option value="4">Thursday</flux:select.option>
                        <flux:select.option value="5">Friday</flux:select.option>
                        <flux:select.option value="6">Saturday</flux:select.option>
                    </flux:select>
                @endif

                @if ($reminderFrequency === 'monthly')
                    <flux:input wire:model="reminderDayOfMonth" label="Day of Month" type="number" min="1" max="28" />
                @endif

                <flux:button wire:click="saveReminder" icon="bell-alert" variant="primary" class="w-full">
                    Save Reminder
                </flux:button>
            </div>
        </flux:card>

        <!-- Scheduled List -->
        <flux:card>
            <div class="flex items-center justify-between mb-3">
                <flux:heading size="lg">Your Reminders</flux:heading>
                <flux:button wire:click="loadScheduled" icon="arrow-path" size="sm" variant="ghost" />
            </div>

            @if (empty($scheduledNotifications))
                <p class="text-sm text-gray-400 dark:text-gray-500 py-4 text-center">No scheduled notifications</p>
            @else
                <div class="space-y-2">
                    @foreach ($scheduledNotifications as $notification)
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                            <div class="min-w-0 flex-1">
                                <p class="font-medium text-sm truncate">{{ $notification['title'] ?? $notification['id'] }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ ucfirst($notification['frequency'] ?? '?') }}
                                    @if (isset($notification['hour']))
                                        at {{ str_pad($notification['hour'], 2, '0', STR_PAD_LEFT) }}:{{ str_pad($notification['minute'] ?? 0, 2, '0', STR_PAD_LEFT) }}
                                    @endif
                                </p>
                            </div>
                            <div class="flex gap-1">
                                <flux:button wire:click="editReminder('{{ $notification['id'] }}')" icon="pencil" size="sm" variant="ghost" />
                                <flux:button wire:click="removeReminder('{{ $notification['id'] }}')" icon="trash" size="sm" variant="danger" />
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if (!empty($scheduledNotifications))
                <flux:button wire:click="cancelAll" icon="x-circle" variant="danger" class="w-full mt-3">
                    Cancel All
                </flux:button>
            @endif
        </flux:card>

        <!-- Last Tap Info -->
        @if ($lastTapInfo)
            <flux:card class="border-2 border-amber-300 dark:border-amber-700">
                <flux:heading size="lg">Last Tap Event</flux:heading>
                <p class="text-sm font-mono mt-2 text-gray-600 dark:text-gray-300 break-all">{{ $lastTapInfo }}</p>
            </flux:card>
        @endif

        <x-quote :quote="$this->randomQuote['quote']" :author="$this->randomQuote['author']" />
    </div>

    <div class="pb-32"></div>
</div>
