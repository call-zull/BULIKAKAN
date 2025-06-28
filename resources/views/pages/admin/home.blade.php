<x-dashboard>
    <div class="px-4 py-6" x-data="{ showDetails: false }" x-init="$nextTick(() => showDetails = true)">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard Admin</h1>

        <div class="grid grid-cols-2 gap-6 transition-all duration-700 ease-in-out" x-show="showDetails" x-transition>
            <!-- Card -->
            <div
                class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:-translate-y-1">
                <div class="flex items-center gap-x-2 mb-2">
                    <div class="text-gray-500 text-sm">Total Pengumuman</div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"
                        id="Announcement-Megaphone--Streamline-Core" class="w-5">
                        <desc>
                            Announcement Megaphone Streamline Icon: https://streamlinehq.com
                        </desc>
                        <g id="annoncement-megaphone">
                            <path id="Vector" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"
                                d="m7.18164 3.74683 3.85766 6.68157" stroke-width="1"></path>
                            <path id="Vector_2" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"
                                d="m10.8373 10.0774 -9.50948 2.2081 -0.60907 -1.055 6.66704 -7.13138" stroke-width="1">
                            </path>
                            <path id="Vector_3" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"
                                d="m3.39648 11.8046 0.52363 0.9069c0.18996 0.3256 0.50147 0.5624 0.86601 0.6583 0.36453 0.0958 0.75223 0.043 1.0778 -0.147 0.32558 -0.1899 0.56236 -0.5014 0.65825 -0.866 0.09589 -0.3645 0.04305 -0.7522 -0.14691 -1.0778l-0.08386 -0.1452"
                                stroke-width="1"></path>
                            <path id="Vector 591" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"
                                d="M7.44397 1.83698V0.583496" stroke-width="1"></path>
                            <path id="Vector 602" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"
                                d="m12.2465 6.63965 1.2535 0" stroke-width="1"></path>
                            <path id="Vector 603" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"
                                d="m1.38873 6.63965 1.25348 0" stroke-width="1"></path>
                            <path id="Vector 605" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"
                                d="m3.16114 2.3573 0.88635 0.88635" stroke-width="1"></path>
                            <path id="Vector 600" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"
                                d="m10.84 3.24353 0.8863 -0.88635" stroke-width="1"></path>
                        </g>
                    </svg>
                </div>
                <div class="text-3xl font-bold text-biruPrimary">{{ $totalPengumuman }}</div>
            </div>

            <div
                class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:-translate-y-1">
                <div class="flex items-center gap-x-2 mb-2">
                    <div class="text-gray-500 text-sm">Pengumuman Kehilangan</div>
                    <x-icon-lost></x-icon-lost>
                </div>
                <div class="text-3xl font-bold text-yellow-500">{{ $totalKehilangan }}</div>
            </div>

            <div
                class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:-translate-y-1">
                <div class="flex items-center gap-x-2 mb-2">
                    <div class="text-gray-500 text-sm">Pengumuman Penemuan</div>
                    <img src="{{ asset('logo/icon-find.png') }}" class="w-5" alt="icon-kehilangan">
                </div>
                <div class="text-3xl font-bold text-green-500">{{ $totalPenemuan }}</div>
            </div>

            <div
                class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:-translate-y-1">
                <div class="flex items-center gap-x-2 mb-2">
                    <div class="text-gray-500 text-sm">Jumlah Pengguna</div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        class="stroke-current text-gray-500">
                        <g fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0-18 0" />
                            <path
                                d="M9 10a3 3 0 1 0 6 0a3 3 0 1 0-6 0m-2.832 8.849A4 4 0 0 1 10 16h4a4 4 0 0 1 3.834 2.855" />
                        </g>
                    </svg>
                </div>
                <div class="text-3xl font-bold text-indigo-500">{{ $totalUser }}</div>
            </div>
        </div>

        <!-- Collapsible Detail -->
        <div class="mt-8">
            <button @click="showDetails = !showDetails"
                class="px-4 py-2 bg-biruPrimary text-white rounded-xl font-semibold cursor-pointer">
                <span x-text="showDetails ? 'Sembunyikan Detail' : 'Tampilkan Detail'"></span>
            </button>
        </div>
    </div>
</x-dashboard>