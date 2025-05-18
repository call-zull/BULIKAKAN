@extends('layouts.app')

@section('title', 'Home')

@section('content')
    {{-- Carousel Mobile Friendly --}}
    <div id="mobile-carousel" class="relative w-full -mt-2.5" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-48 overflow-hidden rounded-lg">
            <!-- Item 1 -->
            <div class="hidden duration-1500 ease-in-out" data-carousel-item>
                <img src="{{ asset('carousel/carousel1.jpg') }}" class="absolute block w-full h-full object-cover" alt="Slide 1">
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-1500 ease-in-out" data-carousel-item>
                <img src="{{ asset('carousel/carousel2.png') }}" class="absolute block w-full h-full object-cover" alt="Slide 2">
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-1500 ease-in-out" data-carousel-item>
                <img src="{{ asset('carousel/carousel3.jpeg') }}" class="absolute block w-full h-full object-cover" alt="Slide 3">
            </div>
        </div>

        <!-- Indicators (optional, bisa dihapus kalau tidak perlu) -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-2 left-1/2 space-x-2">
            <button type="button" class="w-2 h-2 rounded-full bg-gray-300" data-carousel-slide-to="0" aria-label="Slide 1"></button>
            <button type="button" class="w-2 h-2 rounded-full bg-gray-300" data-carousel-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" class="w-2 h-2 rounded-full bg-gray-300" data-carousel-slide-to="2" aria-label="Slide 3"></button>
        </div>
    </div>

    {{-- Content utama --}}

    {{-- Fitur --}}
    <div class="flex justify-center gap-x-4 bg-red-400 mt-2.5">
        {{-- fitur 1 --}}
        <div class="p-2 pt-1 rounded-xl bg-biruPrimary">
            <h2 class="text-xl font-semibold text-white font-sans">Kehilangan</h2>
        </div>
        {{-- fitur 2 --}}   
        <div class="p-2 pt-1 rounded-xl bg-white">
            <h2 class="text-xl font-semibold text-biruPrimary font-sans">Penemuan</h2>
        </div>
    </div>

    <div class="mt-1.5 p-2 bg-green-300">
        <h2 class="text-xl font-semibold">Trend</h2>
        <p class="mt-2">Ini adalah konten utama halaman beranda.</p>
    </div>
    
@endsection
