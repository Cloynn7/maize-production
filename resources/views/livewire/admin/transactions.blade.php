<div class="px-6" x-data="{ newTransactionModal: false, updateTransactionModal: false }">
    <div class="mt-6">
        <div class="flex justify-center items-center">
            <div class="flex items-center w-full md:w-1/2 lg:w-2/3 bg-white px-3 py-4 rounded-full border">
                <i class="fa-solid fa-magnifying-glass mx-2"></i>
                <input type="text" placeholder="Search something..." class="w-full focus:outline-none"
                    wire:model.live.debounce.1s="search" autofocus>
            </div>
        </div>
        <div class="flex justify-between items-center mt-6 md:mx-20">
            <div class="flex items-center gap-x-2">
                <i class="fa-solid fa-couch text-blue-600 text-4xl"></i>
                <div>
                    <h1 class="text-2xl font-semibold">Transactions</h1>
                    <span class="text-sm">Total paid transaction: {{ $totalTransactions }}</span>
                </div>
            </div>
            <button @click="newTransactionModal = true"
                class="fa-solid fa-plus bg-blue-500 hover:bg-blue-600 rounded-full py-3 px-3 text-white"></button>
        </div>
    </div>

    @if (session()->has('bannerError') || session()->has('bannerSuccess'))
        @php
            $bannerType = session()->has('bannerError') ? 'error' : 'success';
            $bannerMessage = session()->has('bannerError') ? session('bannerError') : session('bannerSuccess');
        @endphp

        <div
            class="{{ $bannerType === 'error' ? 'bg-red-100 border border-red-400 text-red-700' : 'bg-green-100 border border-green-400 text-green-700' }} px-8 md:px-10 py-4 flex justify-between mt-6">
            <div>
                <p class="text-xl font-semibold">{{ $bannerType === 'error' ? 'Oops!' : 'Success!' }}</p>
                <p class="text-lg">{{ $bannerMessage }}</p>
            </div>
            <button wire:click='$refresh'>
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <div class="overflow-x-auto mt-6">
        <table class="min-w-full divide-y divide-gray-200 rounded-xl overflow-hidden">
            <thead>
                <tr>
                    <th
                        class="px-6 py-3 bg-gray-300 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                        Status</th>
                    <th
                        class="px-6 py-3 bg-gray-300 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                        Discount Code Used</th>
                    <th
                        class="px-6 py-3 bg-gray-300 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                        Total</th>
                    <th
                        class="px-6 py-3 bg-gray-300 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                        Created At</th>
                    <th
                        class="px-6 py-3 bg-gray-300 text-left text-xs font-medium text-gray-900 uppercase tracking-wider w-20">
                        Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($transactions as $index => $data)
                    <tr wire:key="{{ $data->id }}" class="{{ $index % 2 === 1 ? 'bg-gray-200' : 'bg-white' }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <p
                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full capitalize
                            @php
switch ($data->status) {
                                    case 'accepted':
                                        echo 'bg-green-100 text-green-800';
                                        break;
                                    case 'rejected':
                                        echo 'bg-red-100 text-red-800';
                                        break;
                                    case 'processed':
                                        echo 'bg-yellow-100 text-yellow-800';
                                        break;
                                    default:
                                        echo 'bg-slate-100 text-slate-800';
                                        break;
                                } @endphp">
                                {{ $data->status }}</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                            {{ $data->discountCode->code ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                            {{ 'Rp. ' . number_format($data->total, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($data->created_at)->format('d F, Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-lg text-center">
                            <button type="button" class="fa-solid fa-pen-to-square text-blue-500 hover:cursor-pointer"
                                @click="$dispatch('admin-get-transaction', { id: {{ $data->id }} }); updateTransactionModal = true"></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="my-4">
        {{ $transactions->links() }}
    </div>

    <livewire:admin.new-transaction-modal />
    <livewire:admin.update-transaction-modal />
</div>
