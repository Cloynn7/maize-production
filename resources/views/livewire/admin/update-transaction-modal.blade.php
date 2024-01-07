<div class="fixed inset-0 md:left-64 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50 md:p-4"
    x-cloak x-show="updateTransactionModal">
    <div class="w-[400px] md:w-[500px] lg:w-[1200px] h-auto max-h-[800px] md:max-h-2/3 overflow-y-auto px-6 py-4 mx-4 md:mx-auto text-left bg-white rounded shadow-lg"
        @click.away="updateTransactionModal = false" x-transition:enter="motion-safe:ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
        <div class="flex items-center justify-between mb-4">
            <h5 class="text-black text-lg font-semibold">Update Transaction</h5>
            <button type="button" class="cursor-pointer" @click="updateTransactionModal = false">
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

        @if ($user && $carts)
            <div class="grid grid-cols-1 gap-2">
                <div class="shadow-md rounded-md p-3 border-2">
                    <h1 class="text-xl md:text-2xl font-semibold text-gray-800 mb-2">Transaction Details (ID
                        #{{ $transaction->id }})
                    </h1>
                    <div class="ml-2">
                        <div class="flex flex-col gap-2">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-700 mb-2">
                                    Customer
                                    Information
                                </h2>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 text-gray-600">
                                    <div>
                                        <h3 class="font-semibold">Name</h3>
                                        <p>{{ $user->firstName . ' ' . $user->lastName }}</p>
                                    </div>

                                    <div>
                                        <h3 class="font-semibold">Email</h3>
                                        <p>{{ $user->email }}</p>
                                    </div>

                                    <div>
                                        <h3 class="font-semibold">Phone Number</h3>
                                        <p>{{ $user->phone }}</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h2 class="text-xl font-semibold text-gray-700 mb-2">Payment Details</h2>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 text-gray-600">
                                    <div>
                                        <h3 class="font-semibold">Transaction ID #</h3>
                                        <p>{{ $transaction->id }}</p>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold">Total</h3>
                                        <p> {{ 'Rp. ' . number_format($transaction->total, 0, ',', '.') }}
                                        </p>
                                    </div>

                                    <div>
                                        <h3 class="font-semibold">Discount Code / Ammount</h3>
                                        <p>
                                            @if ($transaction->discount_code_id)
                                                @switch($transaction->discountCode->type)
                                                    @case('percentage')
                                                        {{ $transaction->discountCode->code }} /
                                                        {{ $transaction->discountCode->offer }}%
                                                    @break

                                                    @case('flat')
                                                        {{ $transaction->discountCode->code }} /
                                                        {{ 'Rp. ' . number_format($transaction->discountCode->offer, 0, ',', '.') }}
                                                    @break

                                                    @default
                                                        -
                                                    @break
                                                @endswitch
                                            @else
                                                -
                                            @endif
                                        </p>
                                    </div>

                                    <div>
                                        <h3 class="font-semibold">Date</h3>
                                        <p>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d F, Y H:i') }}
                                        </p>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold">Status</h3>
                                        <p class="mt-3">
                                            @php
                                                switch ($transaction->status) {
                                                    case 'accepted':
                                                        echo '<span class="bg-green-100 text-green-800 p-2 rounded-full"> <i class="fa-regular fa-circle-check"></i> Accepted</span>';
                                                        break;
                                                    case 'processed':
                                                        echo '<span class="bg-yellow-100 text-yellow-800 p-2 rounded-full"> <i class="fa-regular fa-clock"></i> Processed</span>';
                                                        break;
                                                    case 'rejected':
                                                        echo '<span class="bg-red-100 text-red-800 p-2 rounded-full"> <i class="fa-regular fa-circle-xmark"></i> Rejected</span>';
                                                        break;
                                                    default:
                                                        echo '<span class="bg-gray-100 text-gray-800 p-2 rounded-full"> <i class="fa-regular fa-circle-question"></i> Unknown</span>';
                                                        break;
                                                }
                                            @endphp </p>
                                    </div>

                                    <div class="mb-3">
                                        <h3 class="font-semibold">Proof</h3>
                                        <div class="mt-3">
                                            <a class="transition duration-300 ease-in-out bg-[#7c7c7c] hover:bg-[#656565] hover:cursor-pointer py-3 px-6 rounded-lg text-white"
                                                href="{{ asset('storage/' . $transaction->payment_proof) }}"
                                                download="{{ 'tid ' . $transaction->id . '- payment_proof' }}"><i
                                                    class="fa-solid fa-arrow-down"></i> Download</a>
                                            <a class="transition duration-300 ease-in-out border py-3 px-6 rounded-lg text-[#525252] border-[#525252] hover:text-[#292929] hover:border-[#292929] hover:bg-[#efefef] hover:cursor-pointer"
                                                href="{{ asset('storage/' . $transaction->payment_proof) }}"
                                                target="_blank"><i class="fa-solid fa-arrow-up-right-from-square"></i>
                                                Open</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h2 class="text-xl font-semibold text-gray-700 mb-2">Transaction Items</h2>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 text-gray-600">
                                @foreach ($carts as $cartItem)
                                    <div class="shadow-md border-2 rounded-md p-3">
                                        <h1 class="uppercase">
                                            {{ $cartItem->seat->seat . ' / ' . $cartItem->seat->class }}
                                        </h1>
                                        <p> Name:
                                            {{ $cartItem->name }}
                                        </p>
                                        <p> Price:
                                            {{ 'Rp. ' . number_format($cartItem->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- UPDATE FORM -->

                <form class="grid grid-cols-1 gap-4" wire:submit="updateTransaction" method="POST">
                    @csrf
                    <h1 class="text-2xl font-semibold text-gray-800">Update Transaction</h1>
                    <div>
                        <label for="updateStatus" class="block text-sm font-medium text-gray-600">Status</label>
                        <select name="status" id="updateStatus"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500"
                            wire:model="status">
                            <option value="accepted">Accepted</option>
                            <option value="processed">Processed</option>
                            <option value="rejected">Rejected</option>
                        </select>
                        @error('status')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="updatePaymentProof" class="block text-sm font-medium text-gray-600">Payment
                            Proof</label>
                        <input type="file" name="updatePaymentProof" id="updatePaymentProof"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500"
                            accept="image/*" wire:model="paymentProof">
                    </div>

                    <button type="submit"
                        class="w-full mt-4 bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                        Submit
                    </button>
                </form>
            </div>
        @else
            No data found...
        @endif
    </div>
</div>
