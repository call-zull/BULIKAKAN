@extends('layouts.app')

@section('title', 'Home')

@section('content')

    {{-- <div class="max-w-screen-xl mx-auto px-4"> --}}

        <div class="swiper carouselSwiper relative lg:h-[500px] md:h-[400px] h-[200px] md:px-1.5 rounded-xl overflow-hidden">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <img src="{{ asset('carousel/carousel1.jpg') }}" class="w-full h-full object-fill" alt="Slide 1">
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <img src="{{ asset('carousel/carousel2.png') }}" class="w-full h-full object-fill" alt="Slide 2">
                </div>
                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <img src="{{ asset('carousel/carousel3.jpeg') }}" class="w-full h-full object-fill" alt="Slide 3">
                </div>
            </div>

            <!-- Pagination -->
            <div class="swiper-pagination !bottom-2"></div>

            <!-- Navigation (optional) -->
            {{-- <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div> --}}
        </div>

        {{-- Carousel Mobile Friendly --}}
        {{-- <div id="mobile-carousel" class="relative lg:h-[400px] md:h-[400px] h-[200px] md:px-1.5" data-carousel="slide">
            <div class="relative h-full lg:rounded-xl rounded-md overflow-hidden">
                <!-- Item 1 -->
                <div class="hidden duration-1500 ease-in-out h-full" data-carousel-item>
                    <img src="{{ asset('carousel/carousel1.jpg') }}" class="object-fill w-full h-full block" alt="Slide 1">
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-1500 ease-in-out h-full" data-carousel-item>
                    <img src="{{ asset('carousel/carousel2.png') }}" class="object-fill w-full h-full block" alt="Slide 2">
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-1500 ease-in-out h-full" data-carousel-item>
                    <img src="{{ asset('carousel/carousel3.jpeg') }}" class="object-fill w-full h-full block" alt="Slide 3">
                </div>
            </div>

            <!-- Indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 bottom-2 left-1/2 space-x-2">
                <button type="button" class="w-2 h-2 rounded-full bg-gray-300" data-carousel-slide-to="0"
                    aria-label="Slide 1"></button>
                <button type="button" class="w-2 h-2 rounded-full bg-gray-300" data-carousel-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" class="w-2 h-2 rounded-full bg-gray-300" data-carousel-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
        </div> --}}


        {{-- <div id="mobile-carousel" class="relative w-full -mt-2.5" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-48 overflow-hidden rounded-lg">
                <!-- Item 1 -->
                <div class="hidden duration-1500 ease-in-out" data-carousel-item>
                    <img src="{{ asset('carousel/carousel1.jpg') }}" class="absolute block w-full h-full object-cover"
                        alt="Slide 1">
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-1500 ease-in-out" data-carousel-item>
                    <img src="{{ asset('carousel/carousel2.png') }}" class="absolute block w-full h-full object-cover"
                        alt="Slide 2">
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-1500 ease-in-out" data-carousel-item>
                    <img src="{{ asset('carousel/carousel3.jpeg') }}" class="absolute block w-full h-full object-cover"
                        alt="Slide 3">
                </div>
            </div>

            <!-- Indicators (optional, bisa dihapus kalau tidak perlu) -->
            <div class="absolute z-30 flex -translate-x-1/2 bottom-2 left-1/2 space-x-2">
                <button type="button" class="w-2 h-2 rounded-full bg-gray-300" data-carousel-slide-to="0"
                    aria-label="Slide 1"></button>
                <button type="button" class="w-2 h-2 rounded-full bg-gray-300" data-carousel-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" class="w-2 h-2 rounded-full bg-gray-300" data-carousel-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
        </div> --}}

        {{-- Content utama --}}

        {{-- Fitur --}}
        <div class="flex justify-center gap-x-4 mt-2.5">
            {{-- fitur 1 --}}
            <div class="p-2 pt-1 rounded-xl bg-biruPrimary shadow-md shadow-gray-600">
                <h2 class="text-xl font-semibold text-white font-sans">Kehilangan</h2>
            </div>
            {{-- fitur 2 --}}
            <div class="p-2 pt-1 rounded-xl bg-biruCircleShapes shadow-md shadow-gray-600">
                <h2 class="text-xl font-semibold text-biruPrimary font-sans">Penemuan</h2>
            </div>
        </div>

        {{-- Trend & Card --}}
        <div x-data="{ tab: 'kehilangan', view: 'grid', items: Array.from({ length: 10 }, (_, i) => i) }" class="mt-2 p-2">
            <h2 class="text-xl font-semibold lg:text-2xl md:text-2xl">Trend</h2>

            <div class="mt-2 flex items-end justify-between border-b border-gray-300">
                <!-- Tabs -->
                <div class="flex gap-x-3">
                    <button @click="tab = 'kehilangan'" :class="tab === 'kehilangan'
            ? 'bg-biruPrimary text-white border-b-4 border-abuForgot'
            : 'bg-gray-100 text-biruPrimary border-b-4 border-transparent'"
                        class="text-sm font-jomhuria font-semibold py-1.5 px-4 rounded-t-md transition-all duration-300 ease-in-out">
                        Kehilangan
                    </button>
                    <button @click="tab = 'penemuan'" :class="tab === 'penemuan'
            ? 'bg-biruPrimary text-white border-b-4 border-abuForgot'
            : 'bg-gray-100 text-biruPrimary border-b-4 border-transparent'"
                        class="text-sm font-jomhuria font-semibold py-1.5 px-4 rounded-t-md transition-all duration-300 ease-in-out">
                        Penemuan
                    </button>
                </div>

                <div class="flex items-center gap-x-2 bg-white rounded-md shadow px-3 py-2">
                    <button @click="view = 'grid'" :class="view === 'grid' ? 'bg-biruPrimary text-white' : 'text-biruPrimary'"
                        class="p-1 rounded transition-all duration-300 flex items-center justify-center">
                        <img src="{{ asset('logo/grid.svg') }}" alt="Grid Icon" class="w-4 h-4" :class="view === 'grid' ? 'filter brightness-0 invert' : ''" />
                    </button>
                    <button @click="view = 'list'" :class="view === 'list' ? 'bg-biruPrimary text-white' : 'text-biruPrimary'"
                        class="p-1 rounded transition-all duration-300 flex items-center justify-center">
                        <img src="{{ asset('logo/list.svg') }}" alt="List Icon" class="w-4 h-4" :class="view === 'list' ? 'filter brightness-0 invert' : ''" />
                    </button>
                </div>
            </div>

            <div :class="view === 'grid' ? 'grid grid-cols-2 gap-4' : 'grid grid-cols-1 gap-4'" class="px-3 mt-2">
                <template x-for="(item, index) in items" :key="index">
                    <div :class="view === 'grid'
            ? ((index % 4 === 0 || index % 4 === 3)
                ? 'bg-white rounded-xl shadow-md overflow-hidden relative'
                : 'bg-biruPrimary rounded-xl shadow-md overflow-hidden relative')
            : (index % 2 === 0
                ? 'bg-white rounded-xl shadow-md overflow-hidden relative flex items-center'
                : 'bg-biruPrimary rounded-xl shadow-md overflow-hidden relative flex items-center')">
                        <div class="w-full h-48"></div>
                        <div class="absolute bottom-2 right-2">
                            <a href="#" class="text-sm flex items-center gap-x-1 bg-black text-white px-2 py-1 rounded-full">
                                <i data-feather="arrow-up-right" class="w-3 h-3"></i> Learn more
                            </a>
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
                <img src="{{ asset('logo/logo_caption.png') }}" class="w-[220px] lg:w-sm md:w-[340px]" alt="Logo BULIKAKAN">
                <p class="text-center text-xs font-semibold font-jomhuria md:text-lg lg:text-xl"><span class="text-sm lg:text-2xl md:text-xl">BULIKAKAN</span> <br> Merupakan Sistem yang Dirancang untuk Integrasi Pengumuman Kehilangan & Penemuan Barang Bagi Masyarakat Kalimantan Selatan.</p>
            </div>
            <div class="flex flex-col items-center w-full mt-10">
                 <h3 class="font-semibold text-biruPrimary font-jomhuria text-lg lg:text-2xl">
                    Total Pengumuman
                </h3>
                <div class="flex mt-1 w-full justify-around">
                    <div class="flex flex-col text-center">
                        <p class="text-2xl md:text-4xl font-semibold">118</p>
                        <div class="flex gap-x-1.5">
                            <img src="{{ asset('logo/icon-lost2.png') }}" class="w-5" alt="icon-kehilangan">
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

    {{-- </div> --}}

@endsection