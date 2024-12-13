<div>
    <h1>I am a counter component</h1>

    <h2>My Value is: {{ $count }}</h2>

    <div class="flex flex-row justify-start items-center gap-2">

            <button class="bg-blue-500 text-white border-blue-200 hover:bg-blue-800 px-2 py-2 w-10 rounded-md" wire:click="increment">+</button>

            <button class="bg-red-500 text-white border-red-200 hover:bg-red-800 px-2 py-2 w-10 rounded-md" wire:click="decrement">-</button>

    </div>

</div>