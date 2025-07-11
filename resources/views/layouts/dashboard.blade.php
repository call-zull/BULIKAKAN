<!DOCTYPE html>
<html lang="en">

<head>
    {!! seo() !!}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    {{--
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script> --}}

    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/feather-icons"></script>

    @stack('styles')
</head>

<body class="bg-body font-sans" x-data="{ sidebarOpen: false, open: false }">
    <!-- Layout -->
    <div class="flex flex-col md:flex-row">
        <!-- Sidebar -->

        @role('admin')
        @include('components.sidebar-admin')
        @elserole('berwenang')
        @include('components.sidebar-berwenang')
        @endrole


        <!-- Main Content -->
        <div id="main-content" class="w-full overflow-x-hidden">
            @include('includes.admin.navbar')

            <div class="p-2 ml-0">
                {{ $slot }}
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/eca8c42def.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
      <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
    @stack('scripts')
</body>


</html>