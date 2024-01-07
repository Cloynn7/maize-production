<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- ? TailwindCSS --}}
    @vite('resources/css/app.css')

    {{-- ? FontAwesome CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- ? Google Icons --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    {{-- ? jQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    {{-- <script src="../../../node_modules/jquery/dist/jquery.min.js"></script> --}}

    {{-- ? Select2 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- ? SweetAlert2 CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script>

    <title>{{ $title ?? config('app.name') }}</title>
</head>

<body class="bg-gray-100">
    @include('sweetalert::alert')
    <x-livewire-alert::flash />

    @if (request()->routeIs('admin.*'))
        @include('components.admin-sidebar')
        <div class="ml-0 md:ml-64">
            {{ $slot }}
        </div>
    @else
        @include('components.navbar')
        {{ $slot }}
    @endif
</body>

{{-- Scripts --}}

{{-- ? Select2 JS --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@stack('script')

<script>
    $(document).ready(function() {
        $('#selectedSeat').select2({
            placeholder: 'Select a Seat',
            allowClear: true,
        }).on('change', function() {
            var id = $(this).val();
            Livewire.dispatch('updateSelectedSeat', {
                id: id
            });
            // setTimeout(() => {
            //     $('#selectedSeat').select2();
            // }, 1000);
        });
    });
</script>

</html>
