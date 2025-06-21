<x-app-layout title="Home">

    {{-- <div class="max-w-screen-xl mx-auto px-4"> --}}

        <div
            class="swiper carouselSwiper relative lg:h-[500px] md:h-[400px] h-[200px] md:px-1.5 rounded-xl overflow-hidden">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <img src="{{ asset('carousel/carousel-fit1.jpg') }}" class="w-full h-full object-fill"
                        alt="Slide 1">
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <img src="{{ asset('carousel/carousel-fit2.jpg') }}" class="w-full h-full object-fill"
                        alt="Slide 2">
                </div>
                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <img src="{{ asset('carousel/carousel-fit3.jpg') }}" class="w-full h-full object-fill"
                        alt="Slide 3">
                </div>
            </div>

            <!-- Pagination -->
            <div class="swiper-pagination !bottom-2"></div>

            <!-- Navigation (optional) -->
            {{-- <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div> --}}
        </div>

        {{-- Fitur --}}
        <div class="flex justify-center gap-x-4 mt-2.5">
            {{-- fitur 1 --}}
            <a href="/kehilangan"
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
                <h2 class="text-xl font-semibold text-white font-sans">hilanganefewewe</h2>
            </a>
            {{-- fitur 2 --}}
            <a href="/penemuan"
            class="p-2 pt-1 flex gap-x-1.5 items-center rounded-xl bg-biruCircleShapes shadow-md shadow-gray-600">
                <img src="{{ asset('logo/icon-find.png') }}" class="w-5" alt="icon-kehilangan">
                <h2 class="text-xl font-semibold text-biruPrimary font-sans">Penemuan</h2>
            </a>
        </div>

        {{-- Trend & Card --}}
       <div x-data="homeData()" class="mt-2 p-2">
    <h2 class="text-xl font-semibold lg:text-2xl md:text-2xl">Trend Kehilangan</h2>

    <!-- Grid Layout -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4 px-2">
        <template x-for="item in items" :key="item.id">
            <div class="bg-gray-200 shadow-md rounded-xl flex gap-3 p-3">
                <img :src="item.image" class="w-32 h-32 object-cover rounded" alt="Barang Hilang">
                <div class="flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-bold" x-text="item.nama"></h3>
                        <p class="text-sm"><strong>Waktu:</strong> <span x-text="item.waktu"></span></p>
                        <p class="text-sm"><strong>Tempat:</strong> <span x-text="item.tempat"></span></p>
                        <p class="text-sm"><strong>Tipe:</strong> <span x-text="item.tipe"></span></p>
                    </div>
                    <a href="#" class="text-xs text-biruPrimary underline">Lihat Detail</a>
                </div>
            </div>
        </template>
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
            <div class="flex flex-col items-center w-full mt-10">
                <h3 class="font-semibold text-biruPrimary font-jomhuria text-lg lg:text-2xl">
                    Total Pengumuman
                </h3>
                <div class="flex mt-1 w-full justify-around">
                    <div class="flex flex-col text-center">
                        <p class="text-2xl md:text-4xl font-semibold">118</p>
                        <div class="flex gap-x-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"
                                id="Lost-And-Found--Streamline-Core" class="w-5">
                                <desc>
                                    Lost And Found Streamline Icon: https://streamlinehq.com
                                </desc>
                                <g id="lost-and-found">
                                    <path id="Vector" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"
                                        d="M11.5 4h-9c-1.10457 0 -2 0.89543 -2 2v5.5c0 1.1046 0.89543 2 2 2h9c1.1046 0 2 -0.8954 2 -2V6c0 -1.10457 -0.8954 -2 -2 -2Z"
                                        stroke-width="1"></path>
                                    <path id="Vector_2" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.5 4v-0.5c0 -0.66304 0.26339 -1.29893 0.73223 -1.76777C5.70107 1.26339 6.33696 1 7 1c0.66304 0 1.29893 0.26339 1.76777 0.73223C9.23661 2.20107 9.5 2.83696 9.5 3.5V4"
                                        stroke-width="1"></path>
                                    <path id="Vector_3" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"
                                        d="M5.5 7.5c0 -0.29667 0.08797 -0.58668 0.2528 -0.83335 0.16482 -0.24668 0.39909 -0.43894 0.67317 -0.55247 0.27409 -0.11353 0.57569 -0.14324 0.86667 -0.08536 0.29097 0.05788 0.55824 0.20074 0.76802 0.41052 0.20978 0.20978 0.35264 0.47705 0.41052 0.76803 0.05788 0.29097 0.02817 0.59257 -0.08536 0.86666 -0.11353 0.27409 -0.30579 0.50835 -0.55246 0.67318C7.58668 8.91203 7.29667 9 7 9v0.5"
                                        stroke-width="1"></path>
                                    <g id="Group 2631">
                                        <path id="Vector_4" stroke="#000000" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M7.00195 11.5c-0.13807 0 -0.25 -0.1119 -0.25 -0.25s0.11193 -0.25 0.25 -0.25"
                                            stroke-width="1">
                                        </path>
                                        <path id="Vector_5" stroke="#000000" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M7.00195 11.5c0.13807 0 0.25 -0.1119 0.25 -0.25s-0.11193 -0.25 -0.25 -0.25"
                                            stroke-width="1">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            {{-- <img src="{{ asset('logo/icon-lost2.png') }}" class="w-5" alt="icon-kehilangan"> --}}
                            <p class="font-sans text-sm md:text-lg font-semibold">Kehilangan</p>
                        </div>
                    </div>
                    <div class="flex flex-col text-center">
                        <p class="text-2xl md:text-4xl font-semibold">180</p>
                        <div class="flex gap-x-1.5">
                            <img src="{{ asset('logo/icon-find.png') }}" class="w-5" alt="icon-kehilangan">
                            <p class="font-sans text-sm md:text-lg font-semibold">Penemuan</p>
                        </div>
                    </div>

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
            items: [
                {
                    id: 1,
                    nama: 'HP Hilang',
                    waktu: '10 Juni 2025, 14:00 WITA',
                    tempat: 'Lapangan Murjani, Banjarbaru',
                    tipe: 'Elektronik',
                    image: '{{ asset("logo/barang1.png") }}'
                },
                {
                    id: 2,
                    nama: 'Dompet Hilang',
                    waktu: '9 Juni 2025',
                    tempat: 'Pasar Lama',
                    tipe: 'Barang Pribadi',
                    image: '{{ asset("logo/barang1.png") }}'
                },
                {
                    id: 3,
                    nama: 'KTP Hilang',
                    waktu: '8 Juni 2025',
                    tempat: 'Terminal Pal 6',
                    tipe: 'Dokumen',
                    image: '{{ asset("logo/barang1.png") }}'
                },
            ]
        };
    }
</script>
