<!-- Full-screen container -->
<div class="h-[90vh] flex flex-col space-y-6">
    <!-- Header card -->
    <flux:card>
        <flux:heading size="lg" class="flex space-x-2">
            <flux:icon.chat-bubble-left-right variant="mini" class="mr-2"/>
            Reverb!
        </flux:heading>
    </flux:card>

    <div class="flex-1 flex flex-col border border-gray-300 dark:border-gray-700 rounded-xl shadow-md overflow-hidden">
        <div class="flex-1 overflow-y-auto p-4 space-y-2">
            @foreach($messages as $message)
                @if($message['from'] == 'self')
                    <div class="flex justify-end">
                        <div class="bg-blue-600 text-white p-2 rounded-lg rounded-br-none max-w-xs text-sm">
                            {{$message['message']}}
                        </div>
                    </div>
                @else
                    <div class="flex">
                        <div class="bg-white border border-gray-400 text-gray-800 p-2 rounded-lg rounded-bl-none max-w-xs text-sm">
                            {{$message['message']}}
                        </div>
                    </div>
                    <p class="text-[8px] -mt-1">{{$message['user']}}</p>
                @endif
            @endforeach
            <flux:spacer />
        </div>

        <!-- Input pinned to bottom -->
        <div class="border-t border-gray-300 dark:border-gray-700 p-2">
            <form wire:submit.prevent="send" class="flex items-center space-x-2">
                <flux:input wire:model="message" placeholder="Type a message" class="flex-1" />
                <flux:button type="submit" class="rounded-md bg-violet-400 px-4 py-2 text-white">
                    Send
                </flux:button>
            </form>
        </div>
    </div>
</div>
