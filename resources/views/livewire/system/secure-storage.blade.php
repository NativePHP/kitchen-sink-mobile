<div class="space-y-6">
    <flux:card>
        <flux:heading size="lg" class="flex space-x-2">
            <flux:icon.lock-closed variant="mini" class="mr-2"/>
            Secure Storage
        </flux:heading>

        <flux:subheading>
            <p>Test the secure storage functionality using System::secureSet and System::secureGet methods.</p>
        </flux:subheading>
    </flux:card>

    @if($message)
        <flux:card class="border-l-4 border-blue-500 bg-blue-50">
            <p class="text-blue-800">{{ $message }}</p>
            <flux:button variant="ghost" size="sm" wire:click="clearMessage" class="mt-2">Clear</flux:button>
        </flux:card>
    @endif

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
            
            @if($retrievedValue)
                <flux:card class="border-l-4 border-green-500 bg-green-50">
                    <flux:heading>Retrieved Value:</flux:heading>
                    <p class="text-green-800 font-mono">{{ $retrievedValue }}</p>
                </flux:card>
            @endif
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
