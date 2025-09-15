<div>
    <form wire:submit.prevent="register">
        <flux:card class="space-y-6">
            <!-- Session Status -->
            @if (session('status'))
                <div class="text-center text-sm text-green-600 dark:text-green-400">
                    {{ session('status') }}
                </div>
            @endif

            <div>
                <flux:heading size="lg">Create your account</flux:heading>
            </div>

            <div class="space-y-6">
                <flux:input label="Name" type="text" placeholder="Full name" wire:model.defer="name" />

                <flux:input label="Email address" type="email" placeholder="email@example.com" wire:model.defer="email" />

                <flux:field>
                    <flux:label>Password</flux:label>
                    <flux:input type="password" placeholder="••••••••" wire:model.defer="password" />
                    <flux:error name="password" />
                </flux:field>

                <flux:field>
                    <flux:label>Confirm password</flux:label>
                    <flux:input type="password" placeholder="••••••••" wire:model.defer="password_confirmation" />
                    <flux:error name="password_confirmation" />
                </flux:field>
            </div>

            <div class="space-y-2">
                <flux:button type="submit" variant="primary" class="w-full">{{ __('Create account') }}</flux:button>
            </div>
        </flux:card>
    </form>
</div>
