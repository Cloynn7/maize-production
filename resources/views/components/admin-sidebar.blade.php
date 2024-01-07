<div x-data="{ show: true }" x-init="show = window.innerWidth >= 768">
    <div class="flex items-center justify-between px-3 py-2 sm:hidden">
        <h1 class="uppercase">{{ config('app.name') }}</h1>
        <button @click="show = !show"
            class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" fill-rule="evenodd"
                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                </path>
            </svg>
        </button>
    </div>

    <aside x-show="show" @click.away="show = window.innerWidth >= 768 ? show : false"
        :class="{ 'translate-x-0': show, '-translate-x-full': !show }"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-900">
            <a wire:navigate href="{{ route('home') }}" class="flex items-center mb-5">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-6 me-3 sm:h-7"
                    alt="{{ config('app.name') }} Logo" />
                <span
                    class="self-center text-lg font-semibold whitespace-nowrap uppercase text-white">{{ config('app.name') }}</span>
            </a>
            <ul class="space-y-2 font-medium">
                <li>
                    <a wire:navigate href="{{ route('admin.dashboard') }}"
                        class="flex items-center p-2 text-gray-100 rounded-lg hover:bg-gray-700 group
                        @if (request()->routeIs('admin.dashboard')) bg-gray-700 @endif">
                        <i class="fa-solid fa-chart-simple text-gray-400"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a wire:navigate href="{{ route('admin.users') }}"
                        class="flex items-center p-2 text-gray-100 rounded-lg hover:bg-gray-700 group
                        @if (request()->routeIs('admin.users')) bg-gray-700 @endif">
                        <i class="fa-solid fa-user-group text-gray-400"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Users</span>
                    </a>
                </li>
                <li>
                    <a wire:navigate href="{{ route('admin.seats') }}"
                        class="flex items-center p-2 text-gray-100 rounded-lg hover:bg-gray-700 group
                        @if (request()->routeIs('admin.seats')) bg-gray-700 @endif
                        ">
                        <i class="fa-solid fa-couch text-gray-400"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Seats</span>
                    </a>
                </li>
                <li>
                    <a wire:navigate href="{{ route('admin.discounts') }}"
                        class="flex items-center p-2 text-gray-100 rounded-lg hover:bg-gray-700 group
                        @if (request()->routeIs('admin.discounts')) bg-gray-700 @endif">
                        <i class="fa-solid fa-tags text-gray-400"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Discount</span>
                    </a>
                </li>
                <li>
                    <a wire:navigate href="{{ route('admin.transactions') }}"
                        class="flex items-center p-2 text-gray-100 rounded-lg hover:bg-gray-700 group
                        @if (request()->routeIs('admin.transactions')) bg-gray-700 @endif">
                        <i class="fa-solid fa-credit-card text-gray-400"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Transaction</span>
                    </a>
                </li>
            </ul>

            <div class="absolute bottom-5 left-0 w-64 mx-auto">
                <hr class="bg-gray-700 mb-3">
                <div class="flex items-center justify-center gap-x-2">
                    <img src="https://www.gravatar.com/avatar/{{ md5(auth()->user()->email) }}?s=60"
                        class="w-10 h-10 rounded-full" alt="User Avatar">
                    <div>
                        <p class="text-gray-100 font-semibold">
                            {{ auth()->user()->firstName . ' ' . auth()->user()->lastName }}</p>
                        <p class="text-gray-100">{{ auth()->user()->email }}</p>
                    </div>
                    <a href="{{ route('logout') }}"
                        class="flex gap-x-2 items-center p-2 text-gray-100 rounded-lg hover:bg-gray-700">
                        <i class="fa-solid fa-sign-out text-xl text-gray-400"></i>
                    </a>
                </div>
            </div>
        </div>
    </aside>
</div>
