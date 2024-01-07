<div class="container mx-auto mt-8 flex flex-col lg:flex-row" wire:poll.keep-alive.visible>
    <!-- Shopping Cart -->
    <div class="lg:w-2/3 bg-white p-8 rounded shadow-md mb-4 lg:mr-4">
        <h2 class="text-2xl font-semibold mb-4">Your Cart</h2>

        <!-- Cart Items -->
        @if ($items == null)
            <p class="text-gray-600">No items found. Try to go to the <a href="{{ route('cart') }}"
                    class="text-blue-500 underline">cart</a> first then
                checkout from there!</p>
        @else
            @foreach ($items as $item)
                <div class="flex items-center mb-4" wire:key="{{ $item->id }}">
                    <i class="fas fa-chair text-3xl text-gray-500 mr-4"></i>
                    <div>
                        <div class="flex items-center">
                            <h3 class="text-lg font-semibold">Seat:
                                {{ $item->seat->seat . ' - ' . strtoupper($item->seat->class) }}
                            </h3>
                            <span
                                class="{{ $item->seat->status == 'available' ? 'bg-teal-100 text-emerald-900' : 'bg-red-100 text-red-500' }} px-3 py-1 ml-2 rounded-full">{{ $item->seat->status }}</span>
                        </div>
                        <p class="text-gray-600">{{ $item->name }}</p>
                        <p class="text-gray-600">{{ 'Rp. ' . number_format($item->price, 0, ',', '.') }}</p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Checkout Card -->
    <form wire:submit="newOrder" class="lg:w-1/3 flex flex-col p-6 gap-y-4 bg-white shadow-md md:h-1/3">
        @csrf
        @if (session()->has('success') || session()->has('error'))
            @php
                $messageType = session()->has('error') ? 'error' : 'success';
                $message = session()->has('error') ? session('error') : session('success');
            @endphp
            <div
                class="{{ $messageType === 'error' ? 'bg-red-500' : 'bg-green-500' }} flex items-center p-4 text-white">
                <i class="fa-solid fa-circle-info mr-2"></i>
                <p>{{ $message }}</p>
            </div>
        @endif
        <div>
            <h1 class="text-xl font-semibold mb-4">Order Completion</h1>
            <div class="flex justify-between px-4">
                <p class="text-gray-600">Subtotal:</p>
                <p class="font-semibold">{{ 'Rp. ' . number_format($subtotal, 0, ',', '.') }}</p>
            </div>
            <div class="flex justify-between px-4">
                <p class="text-gray-600">Offer:</p>
                <p class="font-semibold">{{ 'Rp. ' . number_format($offer, 0, ',', '.') }}</p>
            </div>
            <div class="flex justify-between px-4">
                <p class="text-gray-600">Promo code used:</p>
                <p class="font-semibold">{{ $promoCode }}</p>
            </div>
            <hr class="my-4">
            <div class="flex justify-between px-4">
                <p class="text-gray-600">Total:</p>
                <p class="font-semibold">{{ 'Rp. ' . number_format($total, 0, ',', '.') }}</p>
            </div>
        </div>

        <div x-data="{ showImage: false }">
            <label for="paymentProof" class="block text-sm font-medium text-gray-600">Upload Payment Proof</label>
            <div class="mt-1 flex items-center">
                <label
                    class="cursor-pointer bg-gray-200 text-gray-600 p-2 rounded-md hover:bg-gray-300 transition duration-300 ease-in-out">
                    <span>Choose File</span>
                    <input type="file" wire:model="paymentProof" id="paymentProof" name="paymentProof" class="hidden"
                        accept="image/*">
                </label>
                <span
                    class="ml-2">{{ $paymentProof ? $paymentProof->getClientOriginalName() : 'No file chosen' }}</span>
            </div>

            @error('paymentProof')
                <span class="text-red-600">{{ $message }}</span>
            @enderror

            @if ($paymentProof)
                <div class="mt-4">
                    <button type="button" class="w-full bg-green-500 text-white py-2 px-4 rounded"
                        @click="showImage = !showImage" x-text="showImage ? 'Hide Image' : 'Show Image'">
                    </button>
                    <img x-show="showImage" src="{{ $paymentProof->temporaryUrl() }}" alt="Payment Proof"
                        class="mt-2 max-w-full h-auto rounded shadow-md" style="display: none;">
                </div>
            @endif

            <p wire:loading wire:target="paymentProof" class="mt-2">Uploading...</p>
        </div>

        <div class="flex flex-col flex-col-reverse md:flex-row gap-y-2 md:gap-x-2">
            <a href="{{ route('cart') }}"
                class="text-center w-full md:w-1/3 bg-red-500 text-white py-2 px-4 rounded"><i
                    class="fa-solid fa-arrow-left-long"></i> Back to
                cart</a>
            <button type="submit"
                class="w-full md:w-2/3 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600"><i
                    class="fa-solid fa-upload"></i> Upload</button>
        </div>
    </form>
</div>
