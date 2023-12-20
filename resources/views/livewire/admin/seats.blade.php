{{-- <div x-data="{ showModal: false }">
    <div class="container mx-auto mt-8">
        <h2 class="text-xl text-center font-semibold mb-4">All Seats</h2>
        <div class="flex justify-between">
            <a @click="showModal = true" class="bg-green-800 p-2 rounded-md text-white cursor-pointer">New Seat</a>
            <!-- Search Input -->
            <input type="text" wire:model.live="search" placeholder="Search ..." class="border">
        </div>

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
                            Seats
                        </th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Class
                        </th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Price
                        </th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Created At
                        </th>
                        <!-- <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action
                        </th> -->
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($seats as $index => $seat)
                        <tr wire:key="{{ $seat->id }}" class="{{ $index % 2 === 0 ? 'bg-gray-100' : 'bg-white' }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $seat->seat }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if ($seat->status == 'available')
                                    <p
                                        class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Available</p>
                                @elseif ($seat->status == 'booked')
                                    <p
                                        class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Booked</p>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 uppercase">
                                {{ $seat->class }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ 'Rp. ' . number_format($seat->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($seat->created_at)->format('d-m-Y') }}
                            </td>
                            <!-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <form action="{{ route('admin.dashboard.seatDelete', $seat->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                        data-confirm-delete="true" disabled>
                                        Delete</button>
                                </form>
                            </td> -->
                        </tr>
                    @endforeach
                </tbody>
                {{ $seats->links() }}
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50"
        x-show="showModal">
        <div class="w-[400px] md:w-[500px] lg:w-[600px] h-auto px-6 py-4 mx-4 md:mx-auto text-left bg-white rounded shadow-lg"
            @click.away="showModal = false" x-transition:enter="motion-safe:ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
            <div class="flex items-center justify-between mb-4">
                <h5 class="text-black text-lg font-semibold">Create New Seat</h5>
                <button type="button" class="cursor-pointer" @click="showModal = false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div>
                <!-- <form class="grid grid-cols-1 gap-4" method="POST" action="{{ route('admin.dashboard.createSeat') }}"> -->
                <form class="grid grid-cols-1 gap-4" method="POST">
                    @csrf
                    <div>
                        <label for="seat" class="block text-sm font-medium text-gray-600">Seat</label>
                        <input type="text" name="seat" id="seat"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500">
                    </div>
                    <div>
                        <label for="class" class="block text-sm font-medium text-gray-600">Class</label>
                        <select name="class" id="class"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500">
                            @foreach ($seats->pluck('class')->unique() as $class)
                                <option value="{{ $class }}" class="uppercase" wire:key='{{ $class }}'>{{ $class }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-600">Price</label>
                        <input type="text" name="price" id="price"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500">
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

<div class="px-6" x-data="{ newSeatModal: false, updateSeatModal: false }">
    <div class="mt-6">
        <div class="flex justify-center items-center">
            <div class="flex items-center w-full md:w-1/2 lg:w-1/3 bg-white px-3 py-4 rounded-full border">
                <i class="fa-solid fa-magnifying-glass mx-2"></i>
                <input type="text" placeholder="Search something..." class="w-full focus:outline-none"
                    wire:model.live.debounce.1s="search" autofocus>
            </div>
        </div>
        <div class="flex justify-between items-center mt-6 md:mx-20">
            <div class="flex items-center gap-x-2">
                <i class="fa-solid fa-couch text-blue-600 text-4xl"></i>
                <div>
                    <h1 class="text-2xl font-semibold">Seats</h1>
                    <span class="text-sm">Total: {{ $totalSeats }}</span>
                </div>
            </div>
            <button @click="newSeatModal = true"
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
                        Seat</th>
                    <th
                        class="px-6 py-3 bg-gray-300 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                        Class</th>
                    <th
                        class="px-6 py-3 bg-gray-300 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                        Status</th>
                    <th
                        class="px-6 py-3 bg-gray-300 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                        Price</th>
                    <th
                        class="px-6 py-3 bg-gray-300 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                        Created At</th>
                    <th
                        class="px-6 py-3 bg-gray-300 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                        Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($seats as $index => $seat)
                    <tr wire:key="{{ $seat->id }}" class="{{ $index % 2 === 1 ? 'bg-gray-200' : 'bg-white' }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">{{ $seat->seat }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500 uppercase">
                            {{ $seat->class }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @if ($seat->status == 'available')
                                <p
                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Available</p>
                            @elseif ($seat->status == 'booked')
                                <p
                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Booked</p>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $seat->price }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($seat->created_at)->format('d-m-Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-lg flex gap-x-4">
                            <button type="button" class="fa-solid fa-pen-to-square text-blue-500 hover:cursor-pointer"
                                @click="$dispatch('admin-update-seat', { id: {{ $seat->id }} }); updateUserModal = true"></button>
                            <button type="button" wire:click="delete({{ $seat->id }})"
                                wire:confirm="Are you sure want to delete {{ $seat->seat . ' with status ' . $seat->status . '' }}?"
                                class="fa-solid fa-trash text-red-500 hover:cursor-pointer"></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="my-4">
        {{ $seats->links() }}
    </div>

    <livewire:admin.new-seat-modal />
    {{-- <livewire:admin.update-user-modal /> --}}
</div>
