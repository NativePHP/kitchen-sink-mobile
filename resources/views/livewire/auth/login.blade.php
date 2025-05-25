<div>
    <form wire:submit.prevent="login">
        <flux:card class="space-y-6">
            <div>
                <flux:heading size="lg">Log in to your account</flux:heading>
            </div>

            <div class="space-y-6">
                <flux:input label="Email" type="email" placeholder="Your email address" wire:model="email"/>

                <flux:field>
                    <div class="mb-3 flex justify-between">
                        <flux:label>Password</flux:label>

                        <flux:link href="#" variant="subtle" class="text-sm">Forgot password?</flux:link>
                    </div>

                    <flux:input type="password" placeholder="Your password" wire:model="password" />

                    <flux:error name="password" />
                </flux:field>
            </div>

            <div class="space-y-2">
                <flux:button type="submit" variant="primary" class="w-full">Log in</flux:button>

                <flux:button variant="ghost" class="w-full">Sign up for a new account</flux:button>
            </div>
        </flux:card>
    </form>
</div>

