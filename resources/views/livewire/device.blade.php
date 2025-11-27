<div class="space-y-6">
    <!-- Header with Gradient -->
    <div class="bg-gradient-to-br from-slate-600 to-gray-600 dark:from-slate-700 dark:to-gray-700 text-white border-0 pb-8 pt-[var(--inset-top)] px-6">
        <div class="space-y-3">
            <div class="flex items-start gap-4">
                <div class="space-y-3">
                    <h1 class="text-white text-3xl font-bold flex items-center space-x-6 pt-2">
                        Device Info
                    </h1>
                    <p class="text-lg text-white">
                        Discover everything about your device - from model info to battery status!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area with Horizontal Padding -->
    <div class="space-y-4 px-4">
        <!-- Device ID Card -->
        <flux:card class="bg-gradient-to-br from-slate-100 to-gray-100 dark:from-slate-800 dark:to-gray-900 border-2 border-slate-300 dark:border-slate-700">
            <flux:heading icon="device-phone-mobile" class="text-slate-900 dark:text-slate-100 mb-4">Device ID</flux:heading>
            <div class="flex flex-col items-start justify-center space-y-2">
                <flux:text class="font-medium text-slate-700 dark:text-slate-300">Your unique device id:</flux:text>
                <flux:badge size="sm" class="bg-gradient-to-r from-slate-500 to-gray-500 text-white border-0">{{str($device_id)}}</flux:badge>
            </div>
            <div class="flex items-center justify-between mt-6 p-3 rounded-lg bg-white/50 dark:bg-gray-800/50">
                <flux:text class="font-semibold">Is iOS?</flux:text>
                <flux:text class="font-bold">{{\Native\Mobile\Facades\System::isIos() ? 'True' : 'False'}}</flux:text>
            </div>
            <div class="flex items-center justify-between p-3 rounded-lg bg-white/50 dark:bg-gray-800/50">
                <flux:text class="font-semibold">Is Android?</flux:text>
                <flux:text class="font-bold">{{\Native\Mobile\Facades\System::isAndroid() ? 'True' : 'False'}}</flux:text>
            </div>
        </flux:card>

        <!-- Device Information Card -->
        <flux:card class="bg-gradient-to-br from-blue-100 to-cyan-100 dark:from-blue-900/30 dark:to-cyan-900/30 border-2 border-blue-200 dark:border-blue-700">
            <flux:heading icon="information-circle" class="text-blue-900 dark:text-blue-100 mb-4">Device Information</flux:heading>
            @foreach(json_decode($device_info) as $key => $value)
                <div class="flex items-center justify-between p-3 rounded-lg bg-white/50 dark:bg-gray-800/50 mb-2">
                    <flux:text class="font-semibold text-blue-800 dark:text-blue-200">{{str($key)}}</flux:text>
                    <flux:text class="font-bold text-blue-900 dark:text-blue-100">{{var_export($value, true)}}</flux:text>
                </div>
            @endforeach
        </flux:card>

        <!-- Battery Info Card -->
        <flux:card wire:poll class="bg-gradient-to-br from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 border-2 border-green-200 dark:border-green-700">
            <flux:heading size="lg" icon="bolt" class="text-green-900 dark:text-green-100 mb-4">Battery Info</flux:heading>

            <div class="flex items-center justify-between p-3 rounded-lg bg-white/50 dark:bg-gray-800/50 mb-2">
                <flux:text class="font-semibold text-green-800 dark:text-green-200">Battery Level</flux:text>
                <flux:text class="font-bold text-green-900 dark:text-green-100">{{round(json_decode($this->battery_info)->batteryLevel * 100, 2)}}%</flux:text>
            </div>
            <div class="flex items-center justify-between p-3 rounded-lg bg-white/50 dark:bg-gray-800/50 mb-4">
                <flux:text class="font-semibold text-green-800 dark:text-green-200">Is Charging</flux:text>
                <flux:text class="font-bold text-green-900 dark:text-green-100">{{json_decode($this->battery_info)->isCharging ? 'true' : 'false'}}</flux:text>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-8 dark:bg-gray-700 border-2 border-white/50">
                <div class="bg-gradient-to-r from-emerald-400 to-cyan-400 h-full rounded-full flex items-center justify-center shadow-lg" style="width: {{json_decode($this->battery_info)->batteryLevel * 100}}%">
                    @if(json_decode($this->battery_info)->isCharging)
                       <p class="p-2 text-xl">⚡</p>
                    @endif
                </div>
            </div>
        </flux:card>

        <x-quote wire:ignore :quote="$this->randomQuote['quote']" :author="$this->randomQuote['author']" />
        <div class="pb-32"></div>
    </div>
</div>
