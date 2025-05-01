<div class="space-y-6">
    <x-layouts.app.callout title="Reverb" icon="chat-bubble-left-right">
        Go ahead and chat a lil :)
    </x-layouts.app.callout>

    <div class="border border-gray-300 dark:border-gray-700 rounded-xl shadow-md p-2 space-y-6 mt-6">
        <div class="flex flex-col justify-between h-[74vh] overflow-y-scroll">
            <div class="flex-1 flex flex-col mb-auto h-[74vh] justify-between overflow-y-scroll">
                <div class=" py-2 flex flex-col space-y-2  ">
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
                </div>
            </div>
            <div class=" w-full p-2">
                <form wire:submit.prevent="send" class="flex items-center space-x-2">
                    <input class="border border-gray-300 rounded-md bg-white text-slate-900 dark:bg-slate-800 px-2 py-2 flex-1 dark:text-gray-200" wire:model="message" type="text" placeholder="Type a message..." />
                    <button type="submit" class="w-1/5 rounded-md bg-violet-400 px-2 py-2 text-gray-200">Send</button>
                </form>
            </div>
        </div>

    </div>
</div>

