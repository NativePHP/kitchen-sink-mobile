<div class="space-y-6">
    <flux:card>
        <flux:heading size="lg" class="flex space-x-2">
            <flux:icon.folder-lock variant="mini" class="mr-2"/>
            Secure Storage
        </flux:heading>

        <flux:subheading>
            <p>Test the secure storage functionality using SecureStorage::set and SecureStorage::get methods.</p>
        </flux:subheading>
    </flux:card>


    <flux:card>
        <flux:heading>Store Secure Value</flux:heading>

        <div class="space-y-4 mt-4">
            <flux:input
                wire:model="key"
                label="Key"
                placeholder="Enter a key name"
                class="w-full"
            />

            <flux:input
                wire:model="value"
                label="Value"
                placeholder="Enter the value to store securely"
                class="w-full"
            />

            <flux:button
                variant="filled"
                icon="lock-closed"
                wire:click="setSecureValue"
                class="w-full"
            >
                Store Secure Value
            </flux:button>
        </div>
    </flux:card>

    <flux:card>
        <flux:heading>Retrieve Secure Value</flux:heading>

        <div class="space-y-4 mt-4">
            <flux:input
                wire:model="retrieveKey"
                label="Key"
                placeholder="Enter the key to retrieve"
                class="w-full"
            />

            <flux:button
                variant="filled"
                icon="key"
                wire:click="getSecureValue"
                class="w-full"
            >
                Retrieve Secure Value
            </flux:button>
        </div>
    </flux:card>

    <flux:card>
        <flux:heading>Delete Secure Value</flux:heading>

        <div class="space-y-4 mt-4">
            <flux:input
                wire:model="deleteKey"
                label="Key"
                placeholder="Enter the key to delete"
                class="w-full"
            />

            <flux:button
                variant="danger"
                icon="trash"
                wire:click="deleteSecureValue"
                class="w-full"
            >
                Delete Secure Value
            </flux:button>
        </div>
    </flux:card>
</div>
