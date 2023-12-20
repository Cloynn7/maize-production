<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- ? TailwindCSS --}}
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    @vite('resources/css/app.css')

    {{-- ? FontAwesome CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- ? Google Icons --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    {{-- ? SweetAlert2 CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>{{ $title ?? config('app.name') }}</title>
</head>

<body class="bg-gray-100">
    @include('sweetalert::alert')
    @if (request()->routeIs('admin.*') || request()->routeIs('test'))
        @include('components.admin-sidebar')
        <div class="ml-0 md:ml-64">
            {{ $slot }}
        </div>
    @else
        @include('components.navbar')
        {{ $slot }}
    @endif
</body>

@if (request()->routeIs('home'))
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
    </script>
@endif

</html>
