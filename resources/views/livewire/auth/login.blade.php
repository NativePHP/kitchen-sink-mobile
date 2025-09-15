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
                    </div>

                    <flux:input type="password" placeholder="Your password" wire:model="password" />

                    <flux:error name="password" />
                </flux:field>
            </div>

            <div class="space-y-2">
                <flux:button type="submit"  class="w-full">Log in</flux:button>

                <div class="flex items-center">
                    <div class="flex-1 border-t border-gray-300"></div>
                    <div class="px-3 text-sm text-gray-500 dark:text-slate-200">or</div>
                    <div class="flex-1 border-t border-gray-300"></div>
                </div>

                <flux:button wire:click="loginWithWorkOS" variant="outline" class="w-full">
                    Log in/Sign up with WorkOS
                </flux:button>
            </div>
        </flux:card>
    </form>
</div>

