<section>
    <div class="container mx-auto mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Card 1: Personal Information -->
        <div class="bg-white p-6 rounded-lg shadow col-span-2">
            <h2 class="text-xl font-semibold mb-4">Personal Information</h2>
            <form wire:submit='update'>
                @csrf
                {{-- @method('PUT') --}}
                <div class="mb-4">
                    <label for="firstName" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" id="firstName" name="firstName" class="mt-1 p-2 w-full border rounded-md"
                        value="{{ auth()->user()->firstName }}" wire:model='firstName'>
                </div>
                <div class="mb-4">
                    <label for="lastName" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" id="lastName" name="lastName" class="mt-1 p-2 w-full border rounded-md"
                        value="{{ auth()->user()->lastName }}" wire:model='lastName'>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="mt-1 p-2 w-full border rounded-md"
                        value="{{ auth()->user()->email }}" wire:model='email'>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="text" id="phone" name="phone" class="mt-1 p-2 w-full border rounded-md"
                        value="{{ auth()->user()->phone }}" wire:model='phone'>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="mt-1 p-2 w-full border rounded-md" wire:model='password'>
                </div>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-700">Save
                    Changes</button>
            </form>
        </div>

        <!-- Card 2: Change Password -->
        <div class="bg-white p-6 rounded-lg shadow flex flex-col justify-center">
            <h2 class="text-xl font-semibold mb-4">Change Password</h2>
            <form wire:submit='changePassword'>
                {{-- @method('PUT') --}}
                @csrf
                <div class="mb-4">
                    <label for="currentPassword" class="block text-sm font-medium text-gray-700">Current
                        Password</label>
                    <input type="password" id="currentPassword" name="currentPassword"
                        class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="newPassword" class="block text-sm font-medium text-gray-700">New Password</label>
                    <input type="password" id="newPassword" name="newPassword"
                        class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-4">
                    <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Confirm
                        Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword"
                        class="mt-1 p-2 w-full border rounded-md">
                </div>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-700">Change
                    Password</button>
            </form>
        </div>
    </div>
</section>