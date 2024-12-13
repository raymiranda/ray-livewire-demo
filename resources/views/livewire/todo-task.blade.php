<div>
    <h1 class="text-xl">Todo Tasks</h1>
    @if(session()->has('task-submit-error'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 3000)"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 transform translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-500"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-2"
        class="bg-red-500 text-white px-2 py-2 rounded-md">
        {{ session('task-submit-error') }}
    </div>
    @endif

    @if(session()->has('task-submit-success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 3000)"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 transform translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-500"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-2"
        class="bg-green-500 text-white px-2 py-2 rounded-md">
        {{ session('task-submit-success') }}
    </div>
    @endif

    <div class="flex flex-col justify-start items-start gap-2 my-5">
        <div class="flex flex-col w-full">
            <form wire:submit="addTask">
                <div class="flex flex-col gap-2">
                    <div class="flex flex-col">
                        <label for="name">Task Name</label>
                        <input type="text" id="name" wire:model="name" class="border border-gray-200 px-2 py-2 rounded-md" placeholder="Task Name" required autocomplete="off">
                        @error('task') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex flex-row gap-2">
                        <div class="flex flex-col">
                            <label for="name">Task Date</label>
                            <input type="date" wire:model="task_date" class="border border-gray-200 px-2 py-2 rounded-md" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" placeholder="Task Date" required>
                            @error('task_date') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="name">Task Time</label>
                            <input type="time" wire:model="task_time" class="border border-gray-200 px-2 py-2 rounded-md" placeholder="Task Time" required>
                            @error('task_time') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        {{-- Was not working in my version of Firefox --}}
                        {{-- <input type="datetime-local" wire:model="task_datetime" class="border border-gray-200 px-2 py-2 rounded-md" placeholder="Task Date/Time"> --}}
                    </div>

                    <div class="flex flex-col">
                        <label for="description">Description</label>
                        <textarea cols="5" rows="10" id="description" wire:model="description" class="border border-gray-200 rounded-md w-full" placeholder="Task description" autocomplete="off"></textarea>
                        @error('description') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>


                <div class="flex flex-row py-2">
                    <div class="flex flex-col justify-center items-end gap-2">
                        <button type="submit" class="bg-blue-500 text-white border-blue-200 hover:bg-blue-800 px-2 py-2 rounded-md">Add</button>

                    </div>
                </div>
            </form>
        </div>

        <div class="w-full">
            @if($todos->isNotEmpty())
            <table class="table w-full">
                <thead>
                    <th class="border">Name</th>
                    <th class="border">Time</th>
                    <th class="border">Description</th>
                    <th class="border">Actions</th>
                </thead>
                <tbody>
                    @foreach($todos as $todo)
                    <tr class="@if($todo->is_done)}} bg-green-200 @endif">
                        <td class="border text-center">{{ $todo->name }}</td>

                        <td class="border text-center">{{ \Carbon\Carbon::parse($todo->task_datetime)->format('m/d/Y h:m A') }}</td>
                        <td class="border text-center text-wrap">{{ ($todo->description) ? $todo->description : "N/A" }}</td>
                        <td class="border text-center flex justify-center gap-2">
                            @if($todo->is_done)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-green-700">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>

                            @else
                            <button wire:click="deleteTask({{$todo->id}})" class="bg-red-500 text-white border-red-200 hover:bg-red-800 px-2 py-2 rounded-md">Delete</button>
                            <button wire:click="completeTask({{$todo->id}})" class="bg-green-500 text-white border-green-200 hover:bg-green-800 px-2 py-2 rounded-md">Completed</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @else
            <p>No tasks found</p>
            @endif

        </div>

    </div>

</div>