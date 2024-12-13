<div>
    <div class="flex flex-row w-full">
        <div class="flex justify-start items-center gap-2 w-full">
            <h1 class="text-xl">Search Tool - Example</h1>
            <div x-show="$wire.showSuccessMessage"
                x-effect="if($wire.showSuccessMessage) { setTimeout(() => $wire.showSuccessMessage = false, 1000) }"
                x-transition.out.opacity.duration.1000ms
                role="alert">
                <p class="text-green-700 text-sm font-bold w-full italic">
                    {{ $successMessage }}</i>
                </p>
            </div>
            <div x-show="$wire.showErrorMessage"
                x-effect="if($wire.showErrorMessage) { setTimeout(() => $wire.showErrorMessage = false, 1000) }"
                x-transition.out.opacity.duration.1000ms
                role="alert">
                <p class="text-red-700 text-sm font-bold w-full italic">
                    {{ $errorMessage }}</i>
                </p>
            </div>

        </div>
    </div>


    <div class="flex flex-col justify-start items-start gap-2 my-5 w-full">
        <div class="flex flex-col w-full">
            <div class="flex flex-row justify-end items-center py-2 gap-2">
                <label for="search">Search User:</label>
                <input type="text" id="search" wire:model.live="search" class="border border-gray-200 px-2 py-2 rounded-md" placeholder="Task Name" required autocomplete="off">
            </div>

            <div class="w-full flex flex-col">
                @if($users->isNotEmpty())
                <div class="flex flex-col py-2 w-full justify-end">
                    {{ $users->links() }}
                </div>
                
                <table class="table w-full">
                    <thead class="bg-slate-300">
                        <th class="border py-2">Name</th>
                        <th class="border py-2">Email</th>
                        <th class="border py-2">Registration Date</th>
                        <th class="border py-2">Actions</th>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr class="@if($loop->even) bg-slate-200 @endif">
                            <td class="border text-center">{{ $user->name }}</td>
                            <td class="border text-center">{{ $user->email}}</td>
                            <td class="border text-center">{{ \Carbon\Carbon::parse($user->created_at)->format('m/d/Y H:m') }}</td>

                            <td class="border text-center flex justify-center gap-2">
                                <button class="bg-green-500 text-white border-green-200 hover:bg-green-800 px-2 py-2 rounded-md">View User</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex flex-col py-2 w-full justify-end">
                {{ $users->links() }}
                </div>
                @else
                <p>No users found</p>
                @endif

            </div>

        </div>

    </div>