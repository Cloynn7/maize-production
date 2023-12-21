<div class="px-6" x-data="{ newDiscountModal: false, updateDiscountModal: false }">
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
                <i class="fa-solid fa-tags text-blue-600 text-4xl"></i>
                <div>
                    <h1 class="text-2xl font-semibold">Discount Codes</h1>
                    <span class="text-sm">Total: {{ $totalDiscounts }}</span>
                </div>
            </div>
            <button @click="newDiscountModal = true"
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
                        Code</th>
                    <th
                        class="px-6 py-3 bg-gray-300 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                        Minimum Price</th>
                    <th
                        class="px-6 py-3 bg-gray-300 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                        Offer</th>
                    <th
                        class="px-6 py-3 bg-gray-300 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                        Maximum Offer</th>
                    <th
                        class="px-6 py-3 bg-gray-300 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                        Start Date</th>
                    <th
                        class="px-6 py-3 bg-gray-300 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                        Expire Date</th>
                    <th
                        class="px-6 py-3 bg-gray-300 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                        Created At</th>
                    <th
                        class="px-6 py-3 bg-gray-300 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                        Use</th>
                    <th
                        class="px-6 py-3 bg-gray-300 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                        Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($discounts as $index => $discount)
                    <tr wire:key="{{ $discount->id }}" class="{{ $index % 2 === 1 ? 'bg-gray-200' : 'bg-white' }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">{{ $discount->code }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                            {{ 'Rp. ' . number_format($discount->min_price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @if ($discount->type === 'percentage')
                                {{ $discount->offer . '%' }}
                            @elseif ($discount->type === 'flat')
                                {{ 'Rp. ' . number_format($discount->offer, 0, ',', '.') }}
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ 'Rp. ' . number_format($discount->max_offer, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($discount->start_date)->format('d F, Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($discount->expire_date)->format('d F, Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($discount->created_at)->format('d F, Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $discount->transactions->first()?->use_count ?? 0 }}x</td>
                        <td class="px-6 py-4 whitespace-nowrap text-lg flex gap-x-4">
                            <button type="button" class="fa-solid fa-pen-to-square text-blue-500 hover:cursor-pointer"
                                @click="$dispatch('admin-get-discount', { id: {{ $discount->id }} }); updateDiscountModal = true"></button>
                            <button type="button" wire:click="delete({{ $discount->id }})"
                                wire:confirm="Are you sure want to delete '{{ $discount->code }}' code?"
                                class="fa-solid fa-trash text-red-500 hover:cursor-pointer"></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="my-4">
        {{ $discounts->links() }}
    </div>

    <livewire:admin.new-discount-modal />
    <livewire:admin.update-discount-modal />
</div>
