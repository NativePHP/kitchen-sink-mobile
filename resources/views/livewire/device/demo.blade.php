<div class="space-y-6">
    <flux:card>
        <flux:heading  class="flex items-center">
            <flux:icon.device-phone-mobile variant="mini" class="mr-2"/>
            Device Demo
        </flux:heading>
        <flux:subheading>
            <p>The Device API exposes internal information about the device, such as the model and operating system
                version, along with user information such as unique ids.</p>
        </flux:subheading>
    </flux:card>

    <flux:card>
        <flux:heading >Device ID</flux:heading>
        <div class="flex flex-col items-start justify-center space-y-2">
            <flux:text>Your unique device id:</flux:text>
            <flux:badge size="sm">{{str($device_id)}}</flux:badge>
        </div>
        <div class="flex items-center justify-between mt-6">
            <flux:text>Is iOS?</flux:text>
            <flux:text>{{\Native\Mobile\Facades\System::isIos() ? 'True' : 'False'}}</flux:text>
        </div>
        <div class="flex items-center justify-between">
            <flux:text>Is Android?</flux:text>
            <flux:text>{{\Native\Mobile\Facades\System::isAndroid() ? 'True' : 'False'}}</flux:text>
        </div>
    </flux:card>

    <flux:card>
        <flux:heading  class="mb-2">Device Information</flux:heading>
        @foreach(json_decode($device_info) as $key => $value)
            <div class="flex items-center justify-between">
                <flux:text>{{str($key)}}</flux:text>
                <flux:text>{{var_export($value, true)}}</flux:text>
            </div>
        @endforeach
    </flux:card>

    <flux:card wire:poll>
        <flux:heading size="lg" class="mb-2">Battery Info</flux:heading>
        @foreach(json_decode($this->battery_info) as $key => $value)
            <div class="flex items-center justify-between">
                <flux:text>{{str($key)}}</flux:text>
                <flux:text>{{var_export($value, true)}}</flux:text>
            </div>
        @endforeach
            <div class="w-full bg-gray-200 rounded-full h-4 dark:bg-gray-700">
                <div class="bg-green-600 h-4 rounded-full mt-4" style="width: {{json_decode($this->battery_info)->batteryLevel * 100}}%"></div>
            </div>
    </flux:card>
</div>
