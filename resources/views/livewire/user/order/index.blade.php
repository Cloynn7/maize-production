<div class="p-8 flex flex-col items-center">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4">Select your favorite {{ strtoupper($class . ' ') }}seat</h1>

        <div class="mb-4">
            <label for="class" class="block text-sm font-medium text-gray-700">Choose Class:</label>
            <select name="class" id="class" wire:model.change="class"
                class="mt-1 p-2 border rounded-md w-full uppercase">
                @foreach ($classes as $classOption)
                    <option value="{{ $classOption }}" class="uppercase">{{ $classOption }}</option>
                @endforeach
            </select>
        </div>

        <form wire:submit.prevent="addToCart">
            @csrf
            <div class="mb-4">
                <label for="selectedSeat" class="block text-sm font-medium text-gray-700">Select Seat:</label>
                <select name="selectedSeat" id="selectedSeat" wire:model="selectedSeat"
                    class="mt-1 p-2 border rounded-md w-full @error('selectedSeat')
                        border border-red-500
                    @enderror">
                    @foreach ($seats as $seat)
                        <option value="{{ $seat->id }}">{{ $seat->seat }}</option>
                    @endforeach
                </select>
                @error('selectedSeat')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Your Name:</label>
                <input type="text" name="name" id="name" wire:model="name"
                    class="mt-1 p-2 border rounded-md w-full
                    @error('name')
                        border border-red-500
                    @enderror"
                    placeholder="By default, this will filled by your account name">
                @error('name')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded w-full hover:bg-blue-600">Add to
                Cart</button>
        </form>

    </div>
</div>
