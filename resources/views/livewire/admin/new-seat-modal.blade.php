<div class="fixed inset-0 md:left-64 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50"
    x-cloak x-show="newSeatModal">
    <div class="w-[400px] md:w-[500px] lg:w-[600px] h-auto px-6 py-4 mx-4 md:mx-auto text-left bg-white rounded shadow-lg"
        @click.away="newSeatModal = false" x-transition:enter="motion-safe:ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
        <div class="flex items-center justify-between mb-4">
            <h5 class="text-black text-lg font-semibold">Create new seat</h5>
            <button type="button" class="cursor-pointer" @click="newSeatModal = false">
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
            <form class="grid grid-cols-1 gap-4" wire:submit="createSeat" method="POST">
                @csrf
                <div>
                    <label for="seat" class="block text-sm font-medium text-gray-600">Seat</label>
                    <input wire:model="seat" type="text" name="seat" id="seat"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500"
                        required>
                    @error('seat')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-600">Status</label>
                    <select name="status" id="status"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500"
                        wire:model="status">
                        <option value="available">Available</option>
                        <option value="booked">Booked</option>
                    </select>
                    @error('status')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="class" class="block text-sm font-medium text-gray-600">Class</label>
                    <select name="class" id="class"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500 
                        @if ($class === null)
                            capitalize
                        @else
                            uppercase
                        @endif"
                        wire:model.change="class" required>
                        <option value="null" class="normal-case" disabled>Select class</option>
                        @foreach ($classes as $class)
                            <option wire:key="{{ $class }}" value="{{ $class }}" class="uppercase">
                                {{ $class }}</option>
                        @endforeach
                    </select>
                    @error('class')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-600">Price</label>
                    <input wire:model="price" type="number" name="price" id="price"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500"
                        required>
                    @error('price')
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
