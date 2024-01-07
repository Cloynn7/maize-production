<div class="grid place-items-center h-screen">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:w-[950px] h-[550px] shadow-lg rounded-lg border">
        <div class="hidden md:block max-h-[550px]">
            <img src="https://picsum.photos/473/500" alt="Photos" class="rounded-l-lg">
        </div>

        <div class="p-8 flex flex-col justify-center">
            <form method="POST" wire:submit.prevent="register">
                @csrf
                <div class="text-center mb-4">
                    <h1 class="text-3xl font-bold">{{ config('app.name') }}</h1>
                    <h2 class="text-md text-gray-700">Create an account to get started!</h2>
                </div>

                <!-- Register Form -->
                <div class="flex flex-col gap-4 w-full">
                    <div>
                        <input type="text" id="firstName" name="firstName" placeholder="First name"
                            class="w-full rounded-full px-5 py-2 transition duration-300 ease-in-out focus:scale-105"
                            required wire:model='firstName'>
                    </div>

                    <div>
                        <input type="text" id="lastName" name="lastName" placeholder="Last name"
                            class="w-full rounded-full px-5 py-2 transition duration-300 ease-in-out focus:scale-105"
                            required wire:model='lastName'>
                    </div>

                    <div>
                        <input type="email" id="email" name="email" placeholder="Email address"
                            class="w-full rounded-full px-5 py-2 transition duration-300 ease-in-out focus:scale-105"
                            required wire:model='email'>
                    </div>

                    <div>
                        <input type="number" id="phone" name="phone" placeholder="Phone number"
                            class="w-full rounded-full px-5 py-2 transition duration-300 ease-in-out focus:scale-105"
                            required wire:model='phone'>
                    </div>

                    <div>
                        <input type="password" id="password" name="password" placeholder="Password"
                            class="w-full rounded-full px-5 py-2 transition duration-300 ease-in-out focus:scale-105"
                            required wire:model='password'>
                    </div>

                    <div>
                        <input type="password" id="confirmPassword" name="confirmPassword"
                            placeholder="Confirm password"
                            class="w-full rounded-full px-5 py-2 transition duration-300 ease-in-out focus:scale-105"
                            required wire:model='confirmPassword'>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit"
                        class="transition duration-300 ease-in-out bg-blue-500 hover:bg-blue-600 hover:scale-110 w-full px-5 py-2 rounded-full text-white"><i
                            class="fa-solid fa-arrow-right-to-bracket"></i> Register</button>
                    <p class="text-sm mt-1">Already have an account? <a href="{{ route('login') }}"
                            class="text-blue-500 underline">click here to
                            login!</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
