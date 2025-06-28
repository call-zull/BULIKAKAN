<div x-cloak :class="sidebarOpen ? 'translate-x-0' : 'md:translate-x-0 -translate-x-full'"
    class="sidebar transform transition-transform duration-300 ease-in-out w-full md:w-80 bg-white text-[#484848] fixed md:sticky top-0 h-screen z-20">
    <!-- Sidebar Toggle Button (visible on mobile) -->
    <div class="md:hidden p-9 absolute">
        <button id="sidebarToggle" class="focus:outline-none" @click="sidebarOpen = !sidebarOpen">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>
    <div class="flex flex-col items-center justify-center bg-sidebar-logo p-6">
        <!-- Logo atau Tulisan -->
       <img class="w-28"
                    src="https://avataaars.io/?avatarStyle=Circle&topType=ShortHairShortFlat&accessoriesType=Blank&hairColor=Blonde&facialHairType=Blank&clotheType=BlazerShirt&eyeType=Happy&eyebrowType=Default&mouthType=Smile&skinColor=Light"
                    alt="Avatar" />
        <span class="text-2xl text-biruPrimary font-bold">Bulikakan</span>
        @role('admin')
            <p class="font-medium text-sm">Admin</p>
        @else
            <p class="font-medium text-sm">Berwenang</p>
        @endrole
        <hr class="w-full border-abuPlaceholder mt-5 border-t-2">
    </div>

    <div class="p-4">
        <div class="text-lg font-bold mb-4">Menu</div>
        <ul>
            <li class="mb-2">
                <a href="{{ route('admin.home') }}"
   class="p-2 rounded flex items-center gap-x-4
          {{ request()->routeIs('admin.home') ? 'bg-primary text-biruPrimary' : 'text-gray-500 hover:bg-primary hover:text-biruPrimary' }}">

                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zM13 21h8V10h-8v11zM13 3v5h8V3h-8z" />
                    </svg>
                    Dashboard
                </a>
            </li>
        </ul>

       <ul x-data="{ open: {{ request()->routeIs('admin.kehilangan.*') || request()->routeIs('admin.penemuan.*') || request()->routeIs('admin.tipe-barang.*') ? 'true' : 'false' }} }">
    <li class="mb-2">
        <button @click="open = !open"
            class="w-full text-left p-2 cursor-pointer hover:bg-primary hover:text-biruPrimary rounded flex items-center justify-between text-gray-500 gap-x-4">
            <span class="flex items-center gap-x-4">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 17h18v2H3v-2zm5-7h3v7H8v-7zm5-4h3v11h-3V6zm5 8h3v3h-3v-3zM3 7h3v10H3V7z" />
                </svg>
                Pengumuman
            </span>
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4 transform transition-transform duration-200"
                :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <ul x-show="open" x-transition class="ml-7 mt-2 space-y-1">
            <!-- Kehilangan -->
            <li>
                <a href="{{ route('admin.kehilangan.index') }}"
                    class="flex items-center gap-x-2 p-2 rounded
                    {{ request()->routeIs('admin.kehilangan.*') ? 'bg-primary text-biruPrimary' : 'text-gray-500 hover:bg-primary hover:text-biruPrimary' }}">
                    <!-- Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 14 14">
                        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11.5 4h-9a2 2 0 0 0-2 2v5.5a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2m-7 0v-.5a2.5 2.5 0 1 1 5 0V4" />
                            <path d="M5.5 7.5A1.5 1.5 0 1 1 7 9v.5m.002 2a.25.25 0 1 1 0-.5m0 .5a.25.25 0 1 0 0-.5" />
                        </g>
                    </svg>
                    Kehilangan
                </a>
            </li>

            <!-- Penemuan -->
            <li>
                <a href="{{ route('admin.penemuan.index') }}"
                    class="flex items-center gap-x-2 p-2 rounded
                    {{ request()->routeIs('admin.penemuan.*') ? 'bg-primary text-biruPrimary' : 'text-gray-500 hover:bg-primary hover:text-biruPrimary' }}">
                    <img src="{{ asset('logo/icon-find.png') }}" class="w-5" alt="icon-kehilangan">
                    Penemuan
                </a>
            </li>

           @role('admin')
    {{-- Jenis Barang --}}
    <li>
        <a href="{{ route('admin.tipe-barang.index') }}"
            class="flex items-center gap-x-2 p-2 rounded
            {{ request()->routeIs('admin.tipe-barang.*') ? 'bg-primary text-biruPrimary' : 'text-gray-500 hover:bg-primary hover:text-biruPrimary' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-tag" viewBox="0 0 16 16">
                <path d="M2 2v3.586l7.293 7.293a1 1 0 0 0 1.414 0L15 8.586a1 1 0 0 0 0-1.414L7.707 0H2a1 1 0 0 0-1 1v1zm1 0h4.586L14 8.414l-4.293 4.293L3 5.586V2z"/>
            </svg>
            Jenis Barang
        </a>
    </li>
@endrole

        </ul>
    </li>
</ul>



        @role('admin')        
        <ul>
            <li class="mb-2">
                <a href="#"
                    class="p-2 hover:bg-primary hover:text-biruPrimary rounded flex items-center gap-x-4 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16">
                        <g fill="none" stroke="currentColor">
                            <path stroke-linejoin="round" d="M10 12.286L11.454 14L14 11" />
                            <path
                                d="M4 13a3 3 0 0 1 3-3h2q.492.002.937.15m-.357 4.157a6.5 6.5 0 1 1 4.757-4.852M10 6a2 2 0 1 1-4 0a2 2 0 0 1 4 0Z" />
                        </g>
                    </svg>
                    Request Official
                </a>
            </li>
        </ul>
      <ul>
    <li class="mb-2">
       <a href="{{ route('admin.users.index') }}"
   class="p-2 flex items-center gap-x-4 rounded
          {{ request()->routeIs('admin.users.*') ? 'bg-primary text-biruPrimary' : 'text-gray-500 hover:bg-primary hover:text-biruPrimary' }}">

            <svg xmlns="http://www.w3.org/2000/svg"
                 width="20" height="20"
                 viewBox="0 0 24 24"
                 class="stroke-current">
                <g fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0-18 0" />
                    <path d="M9 10a3 3 0 1 0 6 0a3 3 0 1 0-6 0m-2.832 8.849A4 4 0 0 1 10 16h4a4 4 0 0 1 3.834 2.855" />
                </g>
            </svg>
            User
        </a>
    </li>

    <li class="mb-2">
       <a href="{{ route('admin.carousel.index') }}"
   class="p-2 flex items-center gap-x-4 rounded
          {{ request()->routeIs('admin.carousel.*') ? 'bg-primary text-biruPrimary' : 'text-gray-500 hover:bg-primary hover:text-biruPrimary' }}">
            <svg viewBox="0 0 24 24"
                 fill="none"
                 xmlns="http://www.w3.org/2000/svg"
                 width="20" height="20"
                 class="stroke-current">
                <path d="M18.874 9c-0.0843 -0.38725 -0.225 -0.67941 -0.4598 -0.91421C17.8284 7.5 16.8856 7.5 15 7.5H9c-1.88562 0 -2.82843 0 -3.41421 0.58579C5 8.67157 5 9.61438 5 11.5v1c0 1.8856 0 2.8284 0.58579 3.4142C6.17157 16.5 7.11438 16.5 9 16.5h6c1.8856 0 2.8284 0 3.4142 -0.5858 0.5316 -0.5315 0.5808 -1.357 0.5853 -2.9142" />
                <path d="M19 2v0.5C19 3.88071 17.8807 5 16.5 5h-9C6.11929 5 5 3.88071 5 2.5V2" />
                <path d="M19 22v-0.5c0 -1.3807 -1.1193 -2.5 -2.5 -2.5h-9C6.11929 19 5 20.1193 5 21.5v0.5" />
            </svg>
            Carousel
        </a>
    </li>
</ul>
        @endrole
    </div>
</div>