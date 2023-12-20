<div class="px-6 overflow-x-auto">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-6">
        <div class="bg-green-600 rounded-lg overflow-hidden shadow-md h-32 text-white p-4 flex flex-col justify-center">
            <h2 class="text-md">Total Users:</h2>
            <div class="flex justify-between items-center">
                <p class="text-3xl font-semibold">{{ $usersCount }}</p>
                <i class="fa-solid fa-user-group p-2 text-xl bg-gray-200 text-green-600 rounded-full"></i>
            </div>
        </div>

        <div class="bg-blue-600 rounded-lg overflow-hidden shadow-md h-32 text-white p-4 flex flex-col justify-center">
            <h2 class="text-md">Total Available Seats:</h2>
            <div class="flex justify-between items-center">
                <p class="text-3xl font-semibold">{{ $availableSeatsCount . ' / ' . $seatsCount }}</p>
                <i class="fa-solid fa-couch p-2 text-xl bg-gray-200 text-blue-600 rounded-full"></i>
            </div>
        </div>

        <div
            class="bg-orange-600 rounded-lg overflow-hidden shadow-md h-32 text-white p-4 flex flex-col justify-center">
            <h2 class="text-md">Total Revenue:</h2>
            <div class="flex justify-between items-center">
                <p class="text-3xl font-semibold"> {{ 'Rp. ' . number_format($totalRevenue, 0, ',', '.') }}
                </p>
                <i class="fa-solid fa-money-bills p-2 text-xl bg-gray-200 text-orange-600 rounded-full"></i>
            </div>
        </div>
    </div>

    <div class="mt-6 block">
        <div class="w-full shadow-md h-auto p-6 border rounded-lg">
            <h2 class="flex items-center gap-x-2 font-semibold text-2xl">
                <i class="fa-solid fa-cart-shopping"></i> <span>Latest Checkouts</span>
            </h2>
            <div class="overflow-x-auto mt-5">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                #
                            </th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Seats - Class
                            </th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Price
                            </th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Discount Code
                            </th>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($latestCheckout as $index => $data)
                            <tr wire:key="{{ $index + 1 }}">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $data->seat . ' - ' . strtoupper($data->class) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $data->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ 'Rp. ' . number_format($data->price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $data->discount_code ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    @php
                                        switch ($data->status) {
                                            case 'processed':
                                                echo '<p class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Processed</p>';
                                                break;
                                            case 'accepted':
                                                echo '<p class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Accepted</p>';
                                                break;
                                            case 'rejected':
                                                echo '<p class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Rejected</p>';
                                                break;
                                            default:
                                                echo '<p class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Unknown</p>';
                                                break;
                                        }
                                    @endphp
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
            <div class="border p-6 shadow-md">
                <h2 class="flex items-center gap-x-2 font-semibold text-2xl">
                    <i class="fas fa-trophy text-yellow-500"></i>
                    <span>Top Buyers</span>
                </h2>

                <ul class="mt-4">
                    @foreach ($topBuyers as $index => $buyer)
                        <li wire:key="{{ $index + 1 }}" class="flex items-center justify-between py-2 border-b">
                            <div>
                                <span class="text-gray-600">{{ $index + 1 . '.' }}</span>
                                <span class="text-blue-500">{{ $buyer->firstName . ' ' . $buyer->lastName }}</span>
                            </div>
                            <span
                                class="text-green-600">{{ 'Rp. ' . number_format($buyer->totalPurchases, 0, ',', '.') }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="border p-6 shadow-md">
                <h2 class="flex items-center gap-x-2 font-semibold text-2xl">
                    <i class="fas fa-user text-blue-500"></i>
                    <span>New Users</span>
                </h2>

                <div class="overflow-x-auto mt-5">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    #
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Phone Number
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($latestUsers as $index => $user)
                                <tr wire:key="{{ $index + 1 }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $user->firstName . ' ' . $user->lastName }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $user->phone }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
