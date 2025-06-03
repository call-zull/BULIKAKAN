<!DOCTYPE html>
<html class="scroll-smooth" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bulikakan')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
    body {
        overflow-x: hidden;
    }
</style>
</head>

<body>
    @if (Request::is('/') || Request::is('profile') || Request::is('kehilangan') || Request::is('penemuan'))
        @include('includes.navbar')
    @endif

    <main class="p-2 lg:mb-20 md:mb-20 mb-20">
        @yield('content')
    </main>

    @include('includes.footer')

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
    {{-- <script>
        document.addEventListener('alpine:init', () => {
            Alpine.effect(() => {
                feather.replace()
            });
        });
    </script> --}}


    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>