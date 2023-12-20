<div class="fixed inset-0 md:left-64 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50"
    x-show="updateUserModal">
    <div @click.away="updateUserModal = false"
        class="w-[400px] md:w-[500px] lg:w-[600px] h-auto px-6 py-4 mx-4 md:mx-auto text-left bg-white rounded shadow-lg"
        x-transition:enter="motion-safe:ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100">
        <div class="flex items-center justify-between mb-4">
            @if ($user !== null)
                <h5 class="text-black text-lg font-semibold">Update {{ $user->firstName . ' ' . $user->lastName }} data
                </h5>
            @endif
            <button type="button" class="cursor-pointer" @click="updateUserModal = false">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        @if (session()->has('success') || session()->has('error'))
            <div class="mb-4">
                @if (session()->has('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif
            </div>
        @endif

        <div>
            <form class="grid grid-cols-1 gap-4" wire:submit="updateUser" method="POST">
                @csrf
                <div>
                    <label for="updateFirstName" class="block text-sm font-medium text-gray-600">First Name</label>
                    <input wire:model="firstName" type="text" name="firstName" id="updateFirstName"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500"
                        required>
                    @error('firstName')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="updateLastName" class="block text-sm font-medium text-gray-600">Last Name</label>
                    <input wire:model="lastName" type="text" name="lastName" id="updateLastName"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500"
                        required>
                    @error('lastName')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="updateEmail" class="block text-sm font-medium text-gray-600">Email</label>
                    <input wire:model="email" type="email" name="email" id="updateEmail"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500"
                        required>
                    @error('email')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="updatePhone" class="block text-sm font-medium text-gray-600">Phone Number</label>
                    <input wire:model="phone" type="number" name="phone" id="updatePhone"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500"
                        required>
                    @error('phone')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center gap-x-2">
                    <input type="checkbox" name="isAdmin" id="updateIsAdmin" value="true" wire:model="isAdmin"
                        @if ($isAdmin) checked @endif>
                    <label for="updateIsAdmin" class="block text-sm font-medium text-gray-600">Is Admin?</label>
                    @error('isAdmin')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center gap-x-2">
                    <input type="checkbox" name="resetPassword" id="resetPassword" value="true"
                        wire:model="resetPassword">
                    <label for="resetPassword" class="block text-sm font-medium text-gray-600">Reset Password?</label>
                    @error('resetPassword')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <button type="submit"
                        class="w-full mt-4 bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
