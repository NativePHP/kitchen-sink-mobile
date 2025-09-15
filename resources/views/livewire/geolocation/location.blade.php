<div class="space-y-6">
    <flux:card>
        <flux:heading size="lg" class="flex space-x-2">
            <flux:icon.map variant="mini" class="mr-2"/>
            Location
        </flux:heading>

        <flux:subheading >
            <p>Press the buttons below to test geolocation functionality.</p>
        </flux:subheading>
    </flux:card>

    <flux:button variant="filled"  wire:click="checkPermissions" class="w-full">Check Permissions</flux:button>
    <flux:button variant="filled"  wire:click="requestPermission" class="w-full">Request Permission</flux:button>
    <flux:button variant="filled"  wire:click="getLocation" class="w-full">Get Location</flux:button>

    @if($result)
        <flux:card>
            <flux:heading>Result:</flux:heading>
            <div class="mt-2 p-3 bg-gray-100 dark:bg-gray-800 rounded-lg">
                <p class="text-sm whitespace-pre-wrap">{{ $result }}</p>
            </div>
        </flux:card>
    @endif
</div>
