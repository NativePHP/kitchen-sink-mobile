<div class=" nativephp-safe-area mt-16">
    <p class="text-7xl  font-bold text-orange-600 text-center">{{$count}}</p>
    <div class="p-10 grid grid-cols-2 gap-4 w-full justify-center">
        <button class="bg-[#272d48] rounded-2xl text-white text-6xl font-bold" wire:click="increment">+</button>
        <button class="bg-[#272d48] rounded-2xl text-white text-6xl font-bold" wire:click="decrement">-</button>
    </div>
    <div class="flex items-center justify-center">
        <a class="text-2xl font-bold text-[#272d48] text-center " href="/counter">Back To Native</a>
    </div>
</div>
