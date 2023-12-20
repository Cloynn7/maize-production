<div>
    @if (session()->has('bannerError') || session()->has('bannerSuccess'))
        @php
            $bannerType = session()->has('bannerError') ? 'error' : 'success';
            $bannerMessage = session()->has('bannerError') ? session('bannerError') : session('bannerSuccess');
        @endphp

        <div
            class="{{ $bannerType === 'error' ? 'bg-red-500' : 'bg-green-500' }} text-white px-8 md:px-10 py-4 flex justify-between">
            <div>
                <p class="text-xl font-semibold">{{ $bannerType === 'error' ? 'Oops!' : 'Success!' }}</p>
                <p class="text-lg">{{ $bannerMessage }}</p>
            </div>
            <button wire:click='$refresh'>
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <div class="container mx-auto mt-8 flex flex-col sm:flex-row md:h-1/3">
        <!-- Shopping Cart -->
        <div class="w-full sm:w-3/4 bg-white p-8 rounded shadow-md mb-4 sm:mr-4">
            <h2 class="text-2xl font-semibold mb-4">Shopping Cart</h2>

            <!-- Cart Items -->
            @if ($carts->isEmpty())
                <p class="text-gray-600">No items in your cart. Order some seat <a href="{{ route('select-seat') }}"
                        class="text-blue-500 underline">here.</a></p>
            @else
                @foreach ($carts as $item)
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
                        <button class="ml-auto bg-red-500 text-white py-2 px-4 rounded"
                            wire:click="remove({{ $item->id }})"><i class="fa-solid fa-trash-can"></i></button>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Cart Summary -->
        <div class="w-full sm:w-1/3 bg-white p-8 rounded shadow-md">
            <h2 class="text-2xl font-semibold mb-4">Cart Summary</h2>
            <div class="flex justify-between items-center">
                <p class="text-gray-600">Subtotal:</p>
                <p class="font-semibold">{{ 'Rp. ' . number_format($subtotal, 0, ',', '.') }}</p>
            </div>
            <div class="flex justify-between items-center mt-2">
                <p class="text-gray-600">Offer:</p>
                <p class="font-semibold">{{ 'Rp. ' . number_format($offer, 0, ',', '.') }}</p>
            </div>
            <div class="flex justify-between items-center mt-2">
                <p class="text-gray-600">Promo code:</p>
                <form wire:submit='applyPromo'>
                    <div class="flex">
                        <input type="text" class="border w-auto p-1" wire:model='promoCode'>
                        <button class="bg-blue-500 py-1 px-3 rounded text-white flex items-center space-x-2"
                            type="submit">
                            <i class="fas fa-check"></i>
                            <span>Apply</span>
                    </div>
                    {{-- <button class="bg-blue-500 py-1 px-3 rounded text-white" type='submit'>Apply</button> --}}
                    </button>
                    <div class="block">
                        @if (session()->has('promoError') || session()->has('promoSuccess'))
                            @php
                                $promoErrorType = session()->has('promoError') ? 'error' : 'success';
                                $promoErrorMessage = session()->has('promoError') ? session('promoError') : session('promoSuccess');
                            @endphp
                            <small
                                class="{{ $promoErrorType === 'error' ? 'text-red-500' : 'text-green-500' }}">{{ $promoErrorMessage }}</small>
                        @endif
                    </div>
                </form>
            </div>
            <hr class="my-4">
            <div class="flex justify-between items-center">
                <p class="text-xl font-semibold">Total:</p>
                <p class="text-xl font-semibold">{{ 'Rp. ' . number_format($total, 0, ',', '.') }}</p>
            </div>
            <button
                class="w-full mt-4 bg-blue-500 text-white px-4 py-2 rounded flex items-center justify-center space-x-2"
                wire:click="checkout">
                <i class="fas fa-shopping-cart"></i>
                <span>Checkout</span>
            </button>
        </div>
    </div>
</div>
