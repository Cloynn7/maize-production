<div>
    <!-- Hero Section -->
    <div class="relative bg-cover bg-center bg-fixed bg-no-repeat h-[900px] flex items-center"
        style="background-image: url({{ asset('images/1R1A7310.jpg') }})">

        <!-- Image Overlay -->
        <div class="absolute inset-0 bg-black opacity-60"></div>

        <!-- Content container -->
        <div class="mx-auto text-center text-white relative z-10">
            <h1 class="text-2xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4">Maizé Production</h1>
            <p class="text-lg md:text-xl lg:text-2xl mb-8 max-w-3xl mx-auto">Lorem ipsum dolor sit amet consectetur
                adipisicing elit. Inventore laborum enim impedit architecto rerum, ipsam quia aperiam pariatur dolores
                culpa.</p>
            <a href="#"
                class="bg-blue-500 hover:bg-blue-700 transition duration-300 ease-in-out text-white font-bold py-2 px-4 rounded"><i
                    class="fa-solid fa-arrow-down"></i> Learn More</a>
        </div>
    </div>

    <!-- Content Section -->
    <div x-data="countdown('May 11, 2024 00:00:00')" class="text-center p-6">
        <h1 class="text-3xl font-semibold">{{ config('app.name') }} Performance Countdown:</h1>
        <div class="flex justify-around mt-2">
            <div>
                <h3 x-text="formatTime.months" class="text-3xl"></h3>
                <span class="text-sm">Months</span>
            </div>
            <div>
                <h3 x-text="formatTime.days" class="text-3xl"></h3>
                <span class="text-sm">Days</span>
            </div>
            <div>
                <h3 x-text="formatTime.hours" class="text-3xl"></h3>
                <span class="text-sm">Hours</span>
            </div>
            <div>
                <h3 x-text="formatTime.minutes" class="text-3xl"></h3>
                <span class="text-sm">Minutes</span>
            </div>
            <div>
                <h3 x-text="formatTime.seconds" class="text-3xl"></h3>
                <span class="text-sm">Seconds</span>
            </div>
        </div>
    </div>

    <div class="container mx-auto flex flex-col lg:flex-row items-center justify-between">
        <!-- Image -->
        <div class="lg:w-1/2 mb-10 lg:mb-0 mr-7">
            <img src="{{ asset('images/1R1A7216.jpg') }}" alt="About Us Image"
                class="w-full h-auto object-cover rounded-xl">
        </div>
        <!-- Content -->
        <div class="lg:w-1/2">
            <h2 class="text-3xl lg:text-4xl font-bold mb-6">About Us</h2>
            <p class="text-gray-700 leading-relaxed mb-6">Lorem ipsum dolor sit amet, consectetur adipiscing
                elit.
                Sed varius aliquet est, vitae consectetur urna gravida ac. Nullam in quam dapibus, tristique
                urna
                sit amet, aliquam metus. Cras non semper mi, at volutpat libero. Phasellus a risus venenatis,
                maximus orci id, vestibulum turpis.</p>
            <p class="text-gray-700 leading-relaxed mb-6">Fusce ullamcorper, felis non congue luctus, ex enim
                convallis lacus, sed interdum ex arcu in dui. Sed ultrices mauris eget metus porta, ac iaculis
                felis
                luctus. Sed fringilla, enim at euismod feugiat, purus augue venenatis eros, id fermentum metus
                purus
                et eros.</p>
            <a href="#"
                class="bg-blue-500 hover:bg-blue-700 transition duration-300 ease-in-out text-white font-bold py-2 px-4 rounded">:v</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center md:text-left">
        <div class="container mx-auto py-8 flex flex-wrap justify-between">

            <!-- Logo and Brand -->
            <div class="w-full md:w-1/4 mb-4 md:mb-0">
                <h1 class="text-2xl font-bold mb-4">{{ config('app.name') }}</h1>
                <p class="text-sm mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>

            <!-- Navigation Links -->
            <div class="w-full md:w-1/4 mb-4 md:mb-0">
                <h2 class="text-lg font-semibold mb-4">Quick Links</h2>
                <ul class="">
                    <li><a href="{{ route('home') }}" class="text-sm" wire:navigate>Home</a></li>
                    <li><a href="{{ route('select-seat') }}" class="text-sm" wire:navigate>Order Seat</a></li>
                    <li><a href="{{ route('cart') }}" class="text-sm" wire:navigate>Cart</a></li>
                    <li><a href="{{ route('user.dashboard') }}" class="text-sm" wire:navigate>Dashboard</a></li>
                </ul>
            </div>

            <!-- Contact Information -->
            <div class="w-full md:w-1/4 mb-4 md:mb-0">
                <h2 class="text-lg font-semibold mb-4">Contact Us</h2>
                <p class="text-sm">123 Street, City</p>
                <a class="text-sm" href="mailto:example@example.com">Email: example@example.com</a>
                <p class="text-sm">Phone: +62 813 8334 9199</p>
            </div>

            <!-- Social Media Links -->
            <div class="w-full md:w-1/4">
                <h2 class="text-lg font-semibold mb-4">Follow Us</h2>
                <div class="flex space-x-4 justify-center md:justify-normal">
                    <a href="https://www.instagram.com/maizetheatre/"
                        target="_blank"class="text-xl hover:scale-150 transition duration-300 ease-in-out"><i
                            class="fab fa-instagram"></i></a>
                    <a href="https://www.tiktok.com/@maizetheatre" target="_blank"
                        class="text-xl hover:scale-150 transition duration-300 ease-in-out"><i
                            class="fab fa-tiktok"></i></a>
                </div>
            </div>

        </div>

        <!-- Copyright and Disclaimer -->
        <div class="bg-gray-700 py-2">
            <div class="container mx-auto flex items-center flex-col justify-center text-sm text-gray-300">
                <span>&copy; 2024 {{ config('app.name') }}. All rights reserved.</span>
                <span>Developed by: <a class="text-blue-500 hover:text-blue-700" href="https://github.com/cloynn7"
                        target="_blank">Izyankareem Retrofi R.</a>
                </span>
            </div>
        </div>
    </footer>

    <!-- Go to Top Button -->
    <button id="goToTopBtn"
        class="hidden fixed bottom-12 md:bottom-8 right-8 bg-blue-500 hover:bg-blue-700 text-white px-4 py-3 text-xl rounded-full cursor-pointer transition duration-300 ease-in-out">
        <i class="fa-solid fa-chevron-up"></i>
    </button>
</div>

@push('script')
    <script>
        window.addEventListener('scroll', function() {
            var goToTopBtn = document.getElementById('goToTopBtn');
            if (window.scrollY > 20) {
                goToTopBtn.classList.remove('hidden');
            } else {
                goToTopBtn.classList.add('hidden');
            }
        });

        document.getElementById('goToTopBtn').addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        function countdown(targetDate) {
            return {
                targetDate: new Date(targetDate).getTime(),
                months: 0,
                days: 0,
                hours: 0,
                minutes: 0,
                seconds: 0,

                updateCountdown() {
                    const now = new Date().getTime();
                    const distance = this.targetDate - now;


                    this.months = Math.floor(distance / (30 * 24 * 60 * 60 * 1000));
                    // this.days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    this.days = Math.floor((distance % (30 * 24 * 60 * 60 * 1000)) / (24 * 60 * 60 * 1000));
                    this.hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    this.minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    this.seconds = Math.floor((distance % (1000 * 60)) / 1000);
                },

                get formatTime() {
                    // return `${this.months} Month${this.months > 1 ? 's' : ''} ${this.days} Days ${this.hours} Hours ${this.minutes} Minutes ${this.seconds} Seconds`;
                    return {
                        months: this.months,
                        days: this.days,
                        hours: this.hours,
                        minutes: this.minutes,
                        seconds: this.seconds
                    };
                },

                init() {
                    setInterval(() => {
                        this.updateCountdown();
                    }, 1000);
                },

                mounted() {
                    this.init();
                },
            };
        };
    </script>
@endpush
