<x-app-layout title="Password Berubah">
    @if (session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded">
        {{ session('success') }}
    </div>
@endif
<div class="relative h-screen overflow-y-hidden bg-white flex justify-center md:items-center px-4 py-10">
    <!-- Quarter circle top-right with responsive icon -->
    <div class="absolute top-0 right-0 w-40 h-40 md:w-52 md:h-52 bg-biruCircleShapes rounded-bl-full overflow-hidden z-0">
        <img src="{{ asset('logo/loop-nobg.png') }}"
             class="absolute -top-4 -right-4 w-28 md:w-36 lg:w-40"
             alt="logo bulikakan">
    </div>

    <!-- Main content -->
    <div class="relative z-10 flex flex-col items-center text-center mt-36 max-w-sm w-full md:mt-0">
        <img src="{{ asset('logo/Successmark.png') }}" alt="Logo Sukses" class="w-24 mb-5 md:w-28 lg:w-32">

        <div class="flex flex-col items-center gap-y-1.5 mb-5">
            <h1 class="text-[#1E232C] font-jomhuria font-bold text-2xl mWd:text-3xl lg:text-4xl">Password Changed</h1>
            <p class="text-[#8391A1] font-jomhuria font-medium text-sm md:text-base max-w-xs">
                Password Anda berhasil dirubah, silakan login kembali.
            </p>
        </div>

        <a href="{{ route('login') }}"
           class="bg-biruPrimary text-white px-6 py-2 w-full rounded-md font-semibold font-jomhuria text-lg md:text-xl">
            Kembali Login
        </a>
    </div>
</div>
</x-app-layout>
