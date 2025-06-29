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
                <a href="{{ route('berwenang.home') }}"
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
            class="w-full text-left p-2 hover:bg-primary cursor-pointer hover:text-biruPrimary rounded flex items-center justify-between text-gray-500 gap-x-4">
            <span class="flex items-center gap-x-4">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
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
                <a href="{{ route(auth()->user()->hasRole('admin') ? 'admin.kehilangan.index' : 'berwenang.kehilangan.index') }}"
                    class="flex items-center gap-x-2 p-2 rounded
                    {{ request()->routeIs('admin.kehilangan.*') || request()->routeIs('berwenang.kehilangan.*') ? 'bg-primary text-biruPrimary' : 'text-gray-500 hover:bg-primary hover:text-biruPrimary' }}">
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
                <a href="{{ route(auth()->user()->hasRole('admin') ? 'admin.penemuan.index' : 'berwenang.penemuan.index') }}"
                    class="flex items-center gap-x-2 p-2 rounded
                    {{ request()->routeIs('admin.penemuan.*') || request()->routeIs('berwenang.penemuan.*') ? 'bg-primary text-biruPrimary' : 'text-gray-500 hover:bg-primary hover:text-biruPrimary' }}">
                    <img src="{{ asset('logo/icon-find.png') }}" class="w-5" alt="icon-kehilangan">
                    Penemuan
                </a>
            </li>

            
        </ul>
    </li>
</ul>




    </div>
</div>