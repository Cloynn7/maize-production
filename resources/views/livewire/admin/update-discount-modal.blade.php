<div class="fixed inset-0 md:left-64 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-cloak
    x-show="updateDiscountModal">
    <div class="w-[400px] md:w-[500px] lg:w-[600px] h-auto px-6 py-4 mx-4 md:mx-auto text-left bg-white rounded shadow-lg"
        @click.away="updateDiscountModal = false" x-transition:enter="motion-safe:ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
        <div class="flex items-center justify-between mb-4">
            @if ($discountCode)
                <h5 class="text-black text-lg font-semibold">Update discount code "{{ $discountCode }}"</h5>
            @endif
            <button type="button" class="cursor-pointer" @click="updateDiscountModal = false">
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
            <form class="grid grid-cols-1 gap-4" wire:submit="updateCode" method="POST">
                @csrf
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-600">Discount Code</label>
                    <input wire:model="code" type="text" name="code" id="code"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500"
                        required>
                    @error('code')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="min_price" class="block text-sm font-medium text-gray-600">Minimum Price</label>
                    <input wire:model="min_price" type="number" name="min_price" id="min_price"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500">
                    @error('min_price')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="offer" class="block text-sm font-medium text-gray-600">Offer</label>
                    <input wire:model="offer" type="number" name="offer" id="offer"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500"
                        required>
                    @error('offer')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-600">Type</label>
                    <select name="type" id="type"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500 capitalize"
                        wire:model.change="type" required>
                        <option value="null" class="normal-case" disabled>Select type</option>
                        @foreach ($types as $type)
                            <option wire:key="{{ $type }}" value="{{ $type }}" class="capitalize">
                                {{ $type }}</option>
                        @endforeach
                    </select>
                    @error('type')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="max_offer" class="block text-sm font-medium text-gray-600">Maximum Offer</label>
                    <input wire:model="max_offer" type="number" name="max_offer" id="max_offer"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500">
                    @error('max_offer')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-600">Start Date</label>
                    <input wire:model="start_date" type="datetime-local" name="start_date" id="start_date"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500" step="1">
                    @error('start_date')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="expire_date" class="block text-sm font-medium text-gray-600">Expire Date</label>
                    <input wire:model="expire_date" type="datetime-local" name="expire_date" id="expire_date"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500" step="1">
                    @error('expire_date')
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
