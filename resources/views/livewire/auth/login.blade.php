<div class="grid place-items-center h-screen">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:w-[950px] h-[500px] shadow-lg rounded-lg border">
        <div class="hidden md:block">
            <img src="https://picsum.photos/473/500" alt="Photos" class="rounded-l-lg">
        </div>

        <div class="flex flex-col justify-center relative">
            @if (session()->has('error'))
                <div class="mb-4 absolute top-0 left-0 w-full">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-tr-lg" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <form method="POST" wire:submit="login" class="p-8">
                @csrf
                <div class="text-center mb-4">
                    <h1 class="text-3xl font-bold">{{ config('app.name') }}</h1>
                    <h2 class="text-md text-gray-700">Welcome back, please login to continue!</h2>
                </div>

                <!-- Login Form -->
                <div class="flex flex-col gap-4 w-full">
                    <div>
                        <input type="email" id="email" name="email" placeholder="Email address"
                            class="w-full rounded-full px-5 py-2 transition duration-300 ease-in-out focus:scale-105"
                            required wire:model='email'>
                        @error('email')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <input type="password" id="password" name="password" placeholder="Password"
                            class="w-full rounded-full px-5 py-2 transition duration-300 ease-in-out focus:scale-105"
                            required wire:model='password'>
                        @error('password')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit"
                        class="transition duration-300 ease-in-out bg-blue-500 hover:bg-blue-600 hover:scale-110 w-full px-5 py-2 rounded-full text-white"><i
                            class="fa-solid fa-arrow-right-to-bracket"></i> Login</button>
                    <p class="text-sm mt-1">Don't have an account? <a href="{{ route('register') }}"
                            class="text-blue-500 underline" wire:navigate>click here to
                            register!</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
