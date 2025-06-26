<x-app-layout title="Home">

    {{-- <div class="max-w-screen-xl mx-auto px-4"> --}}

        <div
            class="swiper carouselSwiper relative lg:h-[500px] md:h-[400px] h-[200px] md:px-1.5 rounded-xl overflow-hidden">
            <div class="swiper-wrapper">
                {{-- <!-- Slide 1 -->
                <div class="swiper-slide">
                    <img src="{{ asset('carousel/2.png') }}" class="w-full h-full object-fill" alt="Slide 1">
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <img src="{{ asset('carousel/4.png') }}" class="w-full h-full object-fill" alt="Slide 2">
                </div>
                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <img src="{{ asset('carousel/8.png') }}" class="w-full h-full object-fill" alt="Slide 3">
                </div> --}}
                @foreach ($carousels as $carousel)
                    <div class="swiper-slide">
                        <a href="{{ $carousel->link ?? '#' }}" target="_blank">
                            <img src="{{ asset('storage/' . $carousel->foto) }}" class="w-full h-full object-fill"
                                alt="{{ $carousel->nama }}">
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="swiper-pagination !bottom-2"></div>

        </div>

        {{-- Fitur --}}
        <div class="flex justify-center gap-x-4 mt-2.5">
            {{-- fitur 1 --}}
            <a href="{{ route('kehilangan') }}"
                class="p-2 flex gap-x-1.5 pt-1 items-center justify-center rounded-xl bg-biruPrimary shadow-md shadow-gray-600">
                {{-- <img src="{{ asset('logo/icon-lost2.png') }}" class="w-auto" alt="icon-kehilangan"> --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"
                    id="Lost-And-Found--Streamline-Core" class="w-5">
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
                <h2 class="text-xl font-semibold text-white font-sans">Kehilangan</h2>
            </a>
            {{-- fitur 2 --}}
            <a href="/penemuan"
                class="p-2 pt-1 flex gap-x-1.5 items-center rounded-xl bg-biruCircleShapes shadow-md shadow-gray-600">
                <img src="{{ asset('logo/icon-find.png') }}" class="w-5" alt="icon-kehilangan">
                <h2 class="text-xl font-semibold text-biruPrimary font-sans">Penemuan</h2>
            </a>
        </div>

        {{-- Trend Kehilangan & Penemuan --}}
        <div x-data="homeData()" class="mt-6 p-4 max-w-6xl mx-auto">
            <h2 class="text-xl font-semibold lg:text-2xl md:text-2xl mb-2">Trend</h2>

            <!-- Tabs + View Toggle -->
            <div
                class="flex flex-col md:flex-row md:items-end md:justify-between border-b border-gray-300 gap-2 md:gap-0">
                <!-- Tabs -->
                <div class="flex gap-x-3">
                    <button @click="tab = 'kehilangan'"
                        :class="tab === 'kehilangan' ? 'bg-biruPrimary text-white border-b-4 border-abuForgot' : 'bg-gray-100 text-biruPrimary border-b-4 border-transparent'"
                        class="text-sm font-semibold py-1.5 px-4 rounded-t-md transition-all duration-300 ease-in-out">
                        Kehilangan
                    </button>
                    <button @click="tab = 'penemuan'"
                        :class="tab === 'penemuan' ? 'bg-biruPrimary text-white border-b-4 border-abuForgot' : 'bg-gray-100 text-biruPrimary border-b-4 border-transparent'"
                        class="text-sm font-semibold py-1.5 px-4 rounded-t-md transition-all duration-300 ease-in-out">
                        Penemuan
                    </button>
                </div>

                <!-- Layout Toggle (nonaktif di mobile) -->
                <div class="hidden md:flex items-center gap-x-2 bg-white rounded-md shadow px-3 py-2 mt-2 md:mt-0">
                    <button @click="view = 'grid'"
                        :class="view === 'grid' ? 'bg-biruPrimary text-white' : 'text-biruPrimary'"
                        class="p-1 rounded transition-all duration-300 flex items-center justify-center">
                        <img src="{{ asset('logo/grid.svg') }}" alt="Grid Icon" class="w-4 h-4"
                            :class="view === 'grid' ? 'filter brightness-0 invert' : ''" />
                    </button>
                    <button @click="view = 'list'"
                        :class="view === 'list' ? 'bg-biruPrimary text-white' : 'text-biruPrimary'"
                        class="p-1 rounded transition-all duration-300 flex items-center justify-center">
                        <img src="{{ asset('logo/list.svg') }}" alt="List Icon" class="w-4 h-4"
                            :class="view === 'list' ? 'filter brightness-0 invert' : ''" />
                    </button>
                </div>
            </div>

            <!-- Card Layout -->
            <div x-show="tab === 'kehilangan'" class="mt-4" x-cloak>
                <div
                    :class="view === 'grid' ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4' : 'flex flex-col gap-4'">
                    <template x-for="(item, index) in kehilanganItems" :key="item.id">
                        <div :class="view === 'grid'
                    ? ((index % 2 === 0) ? 'bg-white text-black' : 'bg-biruPrimary text-white')
                    : ((index % 2 === 0) ? 'bg-white text-black' : 'bg-biruPrimary text-white')"
                            class="shadow-md rounded-xl p-3 flex gap-3" :class="view === 'list' ? 'items-center' : ''">
                            <img :src="item.image" class="w-32 h-32 object-cover rounded" alt="Barang Hilang">
                            <div class="flex flex-col justify-between">
                                <div>
                                    <h3 class="text-lg font-bold" x-text="item.nama"></h3>
                                    <p class="text-sm"><strong>Waktu:</strong> <span x-text="item.waktu"></span></p>
                                    <p class="text-sm"><strong>Tempat:</strong> <span x-text="item.tempat"></span></p>
                                    <p class="text-sm"><strong>Tipe:</strong> <span x-text="item.tipe"></span></p>
                                </div>
                                <a :href="`{{ route('kehilangan.show', '') }}/${item.id}`" class="text-xs underline"
                                    :class="(index % 2 === 0) ? 'text-biruPrimary' : 'text-white'">Lihat Detail</a>


                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <div x-show="tab === 'penemuan'" class="mt-4" x-cloak>
                <div
                    :class="view === 'grid' ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4' : 'flex flex-col gap-4'">
                    <template x-for="(item, index) in penemuanItems" :key="item.id">
                        <div :class="view === 'grid'
                    ? ((index % 2 === 0) ? 'bg-biruPrimary text-white' : 'bg-white text-black')
                    : ((index % 2 === 0) ? 'bg-white text-black' : 'bg-biruPrimary text-white')"
                            class="shadow-md rounded-xl p-3 flex gap-3" :class="view === 'list' ? 'items-center' : ''">
                            <img :src="item.image" class="w-32 h-32 object-cover rounded" alt="Barang Ditemukan">
                            <div class="flex flex-col justify-between">
                                <div>
                                    <h3 class="text-lg font-bold" x-text="item.nama"></h3>
                                    <p class="text-sm"><strong>Waktu:</strong> <span x-text="item.waktu"></span></p>
                                    <p class="text-sm"><strong>Tempat:</strong> <span x-text="item.tempat"></span></p>
                                    <p class="text-sm"><strong>Tipe:</strong> <span x-text="item.tipe"></span></p>
                                </div>
                                <a :href="`{{ route('penemuan.show', '') }}/${item.id}`" class="text-xs underline"
                                    :class="(index % 2 === 0) ? 'text-white' : 'text-biruPrimary'">
                                    Lihat Detail
                                </a>

                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>





        {{-- Sehandap BULIKAKAN --}}
        <div class="mt-7 p-2">
            <div class="flex flex-col items-center lg:px-5 md:px-10">
                <h3 class="font-semibold mt-2 font-jomhuria text-lg lg:text-2xl md:text-xl">
                    Sekilas Tentang <span class="text-biruPrimary font-bold font-jomhuria">"BULIKAKAN"</span>
                </h3>
                <img src="{{ asset('logo/logo_caption.png') }}" class="w-[220px] lg:w-sm md:w-[340px]"
                    alt="Logo BULIKAKAN">
                <p class="text-center text-xs font-semibold font-jomhuria md:text-lg lg:text-xl"><span
                        class="text-sm lg:text-2xl md:text-xl">BULIKAKAN</span> <br> Merupakan Sistem yang Dirancang
                    untuk
                    Integrasi Pengumuman Kehilangan & Penemuan Barang Bagi Masyarakat Kalimantan Selatan.</p>
            </div>
            <div class="flex justify-between items-start w-full px-4 mt-3">
                {{-- Total Kehilangan --}}
                <div class="flex flex-col items-center w-1/3">
                    <p class="text-2xl md:text-4xl font-semibold">{{ $totalKehilangan }}</p>
                    <div class="flex gap-x-1.5 mt-1">
                       <x-icon-lost></x-icon-lost>
                        <p class="font-sans text-sm md:text-lg font-semibold">Kehilangan</p>
                    </div>
                </div>

                {{-- Total Penemuan --}}
                <div class="flex flex-col items-center w-1/3">
                    <p class="text-2xl md:text-4xl font-semibold">{{ $totalPenemuan }}</p>
                    <div class="flex gap-x-1.5 mt-1">
                        <img src="{{ asset('logo/icon-find.png') }}" class="w-5" alt="icon-penemuan">
                        <p class="font-sans text-sm md:text-lg font-semibold">Penemuan</p>
                    </div>
                </div>
            </div>

            {{-- Total Semua di bawah tengah --}}
            <div class="mt-4 text-center">
                <p class="text-2xl md:text-4xl font-bold">{{ $totalSemua }}</p>
                <div class="flex justify-center items-center gap-x-2 mt-1">
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
                    <p class="font-sans text-sm md:text-lg font-semibold">Total Semua</p>
                </div>
            </div>

            <div class="text-center mt-5">
                <p class="font-bold text-xs lg:text-lg">@Copyright by BULIKAKAN 2025</p>
            </div>
        </div>

        {{--
    </div> --}}

</x-app-layout>
<script>
    function homeData() {
        return {
            tab: 'kehilangan',
            view: 'grid',
            kehilanganItems: @json($kehilangan),
            penemuanItems: @json($penemuan),
        }
    }
</script>