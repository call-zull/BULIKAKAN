@php
    $isActive = fn($route) => Route::is($route);
@endphp

<div x-data="{ showAddModal: false, open: false, showLoginAlert: false }"
    x-effect="if (showLoginAlert) showAddModal = false" x-cloak>
    <!-- Footer -->
    <div class="fixed bottom-0 left-0 right-0 z-50 border-t border-t-gray-300 bg-white shadow-md">
        <div class="flex justify-around items-center h-16">
            <!-- Home -->
            <a href="{{ route('home') }}" class="flex flex-col items-center text-biruPrimary">
                <i data-feather="home" class="{{ $isActive('home') ? 'text-biruPrimary' : '' }}"></i>
                <span
                    class="text-xs font-semibold mt-1 px-2 py-0.5 rounded-xl transition-all duration-200 {{ $isActive('home') ? 'bg-biruPrimary text-white' : '' }}">
                    Home
                </span>
            </a>

            <!-- Kehilangan -->
            <a href="{{ route('kehilangan') }}" class="flex flex-col items-center text-biruPrimary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"
                    id="Lost-And-Found--Streamline-Core" class="w-5">
                    <desc>
                        Lost And Found Streamline Icon: https://streamlinehq.com
                    </desc>
                    <g id="lost-and-found">
                        <path id="Vector" stroke="#4682B4" stroke-linecap="round" stroke-linejoin="round"
                            d="M11.5 4h-9c-1.10457 0 -2 0.89543 -2 2v5.5c0 1.1046 0.89543 2 2 2h9c1.1046 0 2 -0.8954 2 -2V6c0 -1.10457 -0.8954 -2 -2 -2Z"
                            stroke-width="1"></path>
                        <path id="Vector_2" stroke="#4682B4" stroke-linecap="round" stroke-linejoin="round"
                            d="M4.5 4v-0.5c0 -0.66304 0.26339 -1.29893 0.73223 -1.76777C5.70107 1.26339 6.33696 1 7 1c0.66304 0 1.29893 0.26339 1.76777 0.73223C9.23661 2.20107 9.5 2.83696 9.5 3.5V4"
                            stroke-width="1"></path>
                        <path id="Vector_3" stroke="#4682B4" stroke-linecap="round" stroke-linejoin="round"
                            d="M5.5 7.5c0 -0.29667 0.08797 -0.58668 0.2528 -0.83335 0.16482 -0.24668 0.39909 -0.43894 0.67317 -0.55247 0.27409 -0.11353 0.57569 -0.14324 0.86667 -0.08536 0.29097 0.05788 0.55824 0.20074 0.76802 0.41052 0.20978 0.20978 0.35264 0.47705 0.41052 0.76803 0.05788 0.29097 0.02817 0.59257 -0.08536 0.86666 -0.11353 0.27409 -0.30579 0.50835 -0.55246 0.67318C7.58668 8.91203 7.29667 9 7 9v0.5"
                            stroke-width="1"></path>
                        <g id="Group 2631">
                            <path id="Vector_4" stroke="#4682B4" stroke-linecap="round" stroke-linejoin="round"
                                d="M7.00195 11.5c-0.13807 0 -0.25 -0.1119 -0.25 -0.25s0.11193 -0.25 0.25 -0.25"
                                stroke-width="1">
                            </path>
                            <path id="Vector_5" stroke="#4682B4" stroke-linecap="round" stroke-linejoin="round"
                                d="M7.00195 11.5c0.13807 0 0.25 -0.1119 0.25 -0.25s-0.11193 -0.25 -0.25 -0.25"
                                stroke-width="1">
                            </path>
                        </g>
                    </g>
                </svg>
                <span
                    class="text-xs font-semibold mt-1 px-2 py-0.5 rounded-xl transition-all duration-200 {{ $isActive('kehilangan') ? 'bg-biruPrimary text-white' : '' }}">
                    Kehilangan
                </span>
            </a>

            <!-- Tombol Plus -->
            {{-- <a href="#" @click.prevent="showAddModal = true"
                class="flex flex-col items-center text-white bg-biruPrimary p-3 rounded-full -mt-6 shadow-lg transition hover:scale-110 duration-300 ease-in-out">
                <i data-feather="plus"></i>
            </a> --}}
            <!-- Tombol Plus -->
            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                class="flex flex-col items-center text-white bg-biruPrimary p-3 rounded-full -mt-6 shadow-lg transition hover:scale-110 duration-300 ease-in-out cursor-pointer"
                type="button">
                <i data-feather="plus"></i>
            </button>

            <!-- Modal Buat Pengumuman -->
            <div id="popup-modal" tabindex="-1" aria-hidden="true"
                class="hidden fixed bottom-32 left-0 right-0 z-50 justify-center flex w-full">
                <div class="bg-white rounded-2xl shadow-xl p-6 w-80 animate-fade-in-up relative">
                    <!-- Tombol Close -->
                    <button type="button"
                        class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 focus:outline-none"
                        data-modal-hide="popup-modal">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    <!-- Konten Modal -->
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 text-center">Buat Pengumuman</h2>

                    <div class="flex justify-between w-full">
                        @auth
                            <a href="{{ route('kehilangan.create') }}"
                                class="flex items-center gap-x-2 px-2 py-1 rounded-lg bg-biruPrimary text-white font-semibold text-center transition duration-200">
                                <x-icon-lost class="text-white w-5" />
                                <h3>Kehilangan</h3>
                            </a>
                        @else
                            <button data-modal-hide="popup-modal" data-modal-target="login-alert-modal"
                                data-modal-toggle="login-alert-modal"
                                class="flex items-center gap-x-2 px-2 py-1 rounded-lg bg-biruPrimary text-white font-semibold text-center transition duration-200">
                                <x-icon-lost class="text-white w-5" />
                                <h3>Kehilangan</h3>
                            </button>
                        @endauth

                        @auth
                            <a href="{{ route('penemuan.create') }}"
                                class="flex items-center px-4 py-2 rounded-lg bg-white text-biruPrimary font-semibold text-center border border-biruPrimary transition duration-200">
                                <img src="{{ asset('logo/icon-find.png') }}" class="w-5 mr-1.5" alt="icon-kehilangan">
                                <h3>Penemuan</h3>
                            </a>
                        @else
                            <button data-modal-hide="popup-modal" data-modal-target="login-alert-modal"
                                data-modal-toggle="login-alert-modal"
                                class="flex items-center px-4 py-2 rounded-lg bg-white text-biruPrimary font-semibold text-center border border-biruPrimary transition duration-200">
                                <img src="{{ asset('logo/icon-find.png') }}" class="w-5 mr-1.5" alt="icon-kehilangan">
                                <h3>Penemuan</h3>
                            </button>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Penemuan -->
            <a href="{{ route('penemuan') }}" class="flex flex-col items-center text-biruPrimary">
                <img src="{{ asset('logo/icon-find.png') }}" class="w-5" alt="icon-kehilangan">
                <span
                    class="text-xs font-semibold mt-1 px-2 py-0.5 rounded-xl transition-all duration-200 {{ $isActive('penemuan') ? 'bg-biruPrimary text-white' : '' }}">
                    Penemuan
                </span>
            </a>

            <!-- Profile -->
            <a href="{{ route('profile.index') }}" class="flex flex-col items-center text-biruPrimary">
                <i data-feather="user"></i>
                <span
                    class="text-xs font-semibold mt-1 px-2 py-0.5 rounded-xl transition-all duration-200 {{ $isActive('profile') ? 'bg-biruPrimary text-white' : '' }}">
                    Profile
                </span>
            </a>
        </div>
    </div>

    <!-- Modal Tambah Pengumuman -->
    <div x-show="showAddModal" x-transition:enter x-cloak
        :class="showAddModal ? 'fixed bottom-32 left-0 right-0 flex justify-center z-50' : 'hidden'">

        <div @click.away="showAddModal = false" class="bg-white rounded-2xl shadow-xl p-6 w-80 animate-fade-in-up">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 text-center">Buat Pengumuman</h2>

            {{-- <div class="flex justify-between w-full ">
                <a href="{{ route('kehilangan.create') }}"
                    class=" flex items-center px-2 py-1 rounded-lg bg-biruPrimary text-white font-semibold text-center transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"
                        id="Lost-And-Found--Streamline-Core" class="w-5 mr-1.5">
                        <desc>
                            Lost And Found Streamline Icon: https://streamlinehq.com
                        </desc>
                        <g id="lost-and-found">
                            <path id="Vector" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round"
                                d="M11.5 4h-9c-1.10457 0 -2 0.89543 -2 2v5.5c0 1.1046 0.89543 2 2 2h9c1.1046 0 2 -0.8954 2 -2V6c0 -1.10457 -0.8954 -2 -2 -2Z"
                                stroke-width="1"></path>
                            <path id="Vector_2" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round"
                                d="M4.5 4v-0.5c0 -0.66304 0.26339 -1.29893 0.73223 -1.76777C5.70107 1.26339 6.33696 1 7 1c0.66304 0 1.29893 0.26339 1.76777 0.73223C9.23661 2.20107 9.5 2.83696 9.5 3.5V4"
                                stroke-width="1"></path>
                            <path id="Vector_3" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round"
                                d="M5.5 7.5c0 -0.29667 0.08797 -0.58668 0.2528 -0.83335 0.16482 -0.24668 0.39909 -0.43894 0.67317 -0.55247 0.27409 -0.11353 0.57569 -0.14324 0.86667 -0.08536 0.29097 0.05788 0.55824 0.20074 0.76802 0.41052 0.20978 0.20978 0.35264 0.47705 0.41052 0.76803 0.05788 0.29097 0.02817 0.59257 -0.08536 0.86666 -0.11353 0.27409 -0.30579 0.50835 -0.55246 0.67318C7.58668 8.91203 7.29667 9 7 9v0.5"
                                stroke-width="1"></path>
                            <g id="Group 2631">
                                <path id="Vector_4" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round"
                                    d="M7.00195 11.5c-0.13807 0 -0.25 -0.1119 -0.25 -0.25s0.11193 -0.25 0.25 -0.25"
                                    stroke-width="1">
                                </path>
                                <path id="Vector_5" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round"
                                    d="M7.00195 11.5c0.13807 0 0.25 -0.1119 0.25 -0.25s-0.11193 -0.25 -0.25 -0.25"
                                    stroke-width="1">
                                </path>
                            </g>
                        </g>
                    </svg>
                    <h3 class="">
                        Kehilangan
                    </h3>
                </a>

                <a href="{{ route('penemuan.create') }}"
                    class="flex items-center px-4 py-2 rounded-lg bg-white text-biruPrimary font-semibold text-center border border-biruPrimary  transition duration-200">
                    <img src="{{ asset('logo/icon-find.png') }}" class="w-5 mr-1.5" alt="icon-kehilangan">
                    <h3>
                        Penemuan
                    </h3>
                </a>
            </div> --}}
            <div class="flex justify-between w-full ">
                @auth
                    <a href="{{ route('kehilangan.create') }}"
                        class="flex items-center gap-x-2 px-2 py-1 rounded-lg bg-biruPrimary text-white font-semibold text-center transition duration-200">
                        <x-icon-lost class="text-white w-5" />
                        <h3>Kehilangan</h3>
                    </a>
                @else
                    <button @click="showLoginAlert = true"
                        class="flex items-center cursor-pointer gap-x-2 px-2 py-1 rounded-lg bg-biruPrimary text-white font-semibold text-center transition duration-200">
                        <x-icon-lost class="text-white w-5" />
                        <h3>Kehilangan</h3>
                    </button>
                @endauth


                @auth
                    <a href="{{ route('penemuan.create') }}"
                        class="flex items-center px-4 py-2 rounded-lg bg-white text-biruPrimary font-semibold text-center border border-biruPrimary transition duration-200">
                        <img src="{{ asset('logo/icon-find.png') }}" class="w-5 mr-1.5" alt="icon-kehilangan">
                        <h3>Penemuan</h3>
                    </a>
                @else
                    <button @click="showLoginAlert = true"
                        class="flex items-center cursor-pointer px-4 py-2 rounded-lg bg-white text-biruPrimary font-semibold text-center border border-biruPrimary transition duration-200">
                        <img src="{{ asset('logo/icon-find.png') }}" class="w-5 mr-1.5" alt="icon-kehilangan">
                        <h3>Penemuan</h3>
                    </button>
                @endauth

            </div>

        </div>

    </div>
    <!-- Alert: Harus login dulu -->
    {{-- <div x-show="showLoginAlert" x-transition x-cloak
        class="fixed inset-0 bg-transparent flex items-center justify-center z-50">
        <div @click.away="showLoginAlert = false" class="bg-white rounded-xl p-4 w-72 shadow-xl text-center">
            <h2 class="text-lg font-bold text-gray-800 mb-2">Login Diperlukan</h2>
            <p class="text-sm text-gray-600 mb-4">Anda harus login terlebih dahulu untuk mengakses fitur ini.</p>
            <div class="flex justify-center gap-3">
                <button @click="showLoginAlert = false"
                    class="px-4 py-1 bg-gray-300 text-gray-800 rounded cursor-pointer hover:bg-gray-400">Tutup</button>
                <a href="{{ route('login') }}" class="px-4 py-1 bg-biruPrimary text-white rounded">Login</a>
            </div>
        </div>
    </div> --}}
    <!-- Modal Login Alert -->
<div id="login-alert-modal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
    <div class="bg-white rounded-xl p-4 w-72 shadow-xl text-center relative">
        <!-- Tombol Close -->
        <button type="button"
            class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 focus:outline-none"
            data-modal-hide="login-alert-modal">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <h2 class="text-lg font-bold text-gray-800 mb-2">Login Diperlukan</h2>
        <p class="text-sm text-gray-600 mb-4">Anda harus login terlebih dahulu untuk mengakses fitur ini.</p>
        <div class="flex justify-center gap-3">
            <button type="button" data-modal-hide="login-alert-modal"
                class="px-4 py-1 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                Tutup
            </button>
            <a href="{{ route('login') }}"
                class="px-4 py-1 bg-biruPrimary text-white rounded hover:bg-biruPrimary/90">Login</a>
        </div>
    </div>
</div>


</div>