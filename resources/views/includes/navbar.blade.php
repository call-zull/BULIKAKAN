<div x-data="{ open: false, scroll: false, confirmLogout: false }" x-init="
        window.addEventListener('scroll', () => {
            scroll = window.scrollY > 5;
            if (scroll) open = false;
        });
    " x-effect="if (confirmLogout) open = false">
    <!-- Navbar -->
    <div :class="scroll
        ? 'py-1 bg-white shadow-md fixed top-0 left-0 right-0 z-50'
        : 'py-1 bg-transparent relative'" class="w-full border-b border-b-gray-300" @click.away="open = false">

        <div class="flex items-center justify-between px-4">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="">
                <div class="flex items-center ">
                    <img class="h-16 w-auto" src="{{ asset('logo/loop-nobg.png') }}" alt="Logo">
                    <h1 class="text-2xl text-biruPrimary font-bold font-jomhuria">Bulikakan</h1>
                </div>
            </a>

            <!-- Icon -->
            <div class="flex gap-x-3 items-center">
                {{-- fitur notifikasi aktivitas --}}
                {{-- <i data-feather="bell" width="20" height="20"
                    class="fill-biruPrimary stroke-biruPrimary stroke-2"></i> --}}
                <!-- Notifikasi -->
                <div class="relative" x-data="{ showNotif: false }">
                    @auth
                    <button @click="showNotif = !showNotif" class="relative focus:outline-none">
                        <i data-feather="bell" width="24" height="24"
                              style="fill: #4682B4; stroke: #4682B4; stroke-width: 2px;"
                                class="cursor-pointer mt-1.5"></i>
                        @if (auth()->user()?->unreadNotifications->count())
                            <span
                                class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </button>
                    
                    <!-- Dropdown Notifikasi -->
                    {{-- <div x-show="showNotif" x-transition @click.away="showNotif = false"
                        class="absolute right-0 mt-2 w-80 max-h-96 overflow-y-auto bg-white border border-gray-200 shadow-lg rounded-md z-50">
                        --}}

                        <div x-show="showNotif" x-transition @click.away="showNotif = false" x-cloak
                         class="absolute right-0 mt-2 w-80 max-h-96 overflow-y-auto bg-white border border-gray-200 shadow-lg rounded-md z-50">
                            <div class="py-2 px-4 text-sm font-semibold text-biruPrimary border-b">Notifikasi</div>
                            @forelse (auth()->user()->notifications->take(5) as $notification)
                                <a href="{{ route('notifications.read', $notification->id) }}"
                                    class="block px-4 py-2 hover:bg-gray-100 text-sm text-gray-700 border-b">
                                    <div class="{{ $notification->read_at ? '' : 'font-bold' }}">
                                        {{ $notification->data['message'] ?? 'Notifikasi baru' }}
                                    </div>
                                    <div class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}
                                    </div>
                                </a>
                            @empty
                                <div class="px-4 py-4 text-sm text-gray-500 text-center">Tidak ada notifikasi</div>
                            @endforelse
                            <div class="text-center py-2">
                                <a href="{{ route('notifications.markAllRead') }}"
                                    class="text-sm text-biruPrimary hover:underline">Tandai semua sudah dibaca</a>
                            </div>
                        </div>
                    @endauth
                    {{-- </div> --}}

                    {{-- dropdown menu --}}
                    <button @click="open = !open" class="text-biruPrimary cursor-pointer focus:outline-none relative">
                        <i data-feather="menu" width="30" height="30"></i>
                    </button>
                </div>
            </div>

            <!-- Floating Dropdown -->
            <div x-show="open" x-transition
                class="absolute top-full right-4 mt-2 w-48 bg-white rounded shadow-lg border border-gray-200 py-2 space-y-2 text-sm md:text-base font-semibold text-biruPrimary z-40">
                <a href="{{ route('tutorial') }}" class="block px-4 py-2 hover:bg-gray-100 transition">Tutorial</a>
                <a href="{{ route('contact.show') }}" class="block px-4 py-2 hover:bg-gray-100 transition">Contact
                    Kami</a>
                @role('admin')
                <a href="{{ route('admin.home') }}" class="block px-4 py-2 hover:bg-gray-100 transition">Admin Panel</a>
                @endrole
                @role('berwenang')
                <a href="{{ route('berwenang.home') }}" class="block px-4 py-2 hover:bg-gray-100 transition">Berwenang
                    Panel</a>
                @endrole
                @auth
                    @role('user')
                    <a href="{{ route('request-official.create') }}"
                        class="block px-4 py-2 hover:bg-gray-100 transition">Request Official</a>
                    <button @click="confirmLogout = true" type="button"
                        class="block w-full text-left px-4 py-2 cursor-pointer hover:bg-gray-100 transition">
                        Logout
                    </button>
                    @endrole
                @endauth
            </div>
        </div>

        <!-- Modal Konfirmasi Logout -->
        <div x-show="confirmLogout" x-transition x-cloak
            :class="confirmLogout ? 'fixed inset-0 flex items-center justify-center z-50' : 'hidden'">
            <div @click.away="confirmLogout = false" class="bg-white rounded-lg shadow-xl p-6 w-80">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">Konfirmasi Logout</h2>
                <p class="text-sm text-gray-600 mb-4">Apakah Anda yakin ingin logout?</p>

                <div class="flex justify-end gap-2">
                    <button @click="confirmLogout = false"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">Batal</button>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 bg-biruPrimary text-white cursor-pointer rounded transition">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>