<x-error-layout :title="'404 - Halaman Tidak Ditemukan'">
    <div class="relative h-screen bg-white flex justify-center items-center overflow-hidden px-4 py-10">
        <!-- Quarter circle top-right with responsive icon -->
        <div class="absolute top-0 right-0 w-40 h-40 md:w-52 md:h-52 bg-biruCircleShapes rounded-bl-full overflow-hidden z-0">
            <img src="{{ asset('logo/loop-nobg.png') }}"
                 class="absolute -top-4 -right-4 w-28 md:w-36 lg:w-40"
                 alt="Logo Bulikakan">
        </div>

        <!-- Main content -->
        <div class="relative z-10 flex flex-col items-center text-center max-w-sm w-full">
            <img src="{{ asset('logo/icon-error.svg') }}" alt="Error Icon" class="w-24 mb-5 md:w-28 lg:w-32">

            <div class="flex flex-col items-center gap-y-1.5 mb-5">
                <h1 class="text-[#1E232C] font-jomhuria font-bold text-2xl md:text-3xl lg:text-4xl">
                    Halaman Tidak Ditemukan
                </h1>
                <p class="text-[#8391A1] font-jomhuria font-medium text-sm md:text-base max-w-xs">
                    Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.
                </p>
            </div>

            <a href="{{ url('/') }}"
               class="bg-biruPrimary text-white px-6 py-2 w-full rounded-md font-semibold font-jomhuria text-lg md:text-xl">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</x-error-layout>
