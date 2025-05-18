@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="relative">
    <!-- Quarter circle top-right -->
    <div class="absolute -top-5 right-0 w-52 h-52 bg-biruCircleShapes rounded-bl-full z-0"></div>

    <div class="relative z-10 px-2">
        <div class="mt-5 ml-2 flex flex-col gap-y-1.5">
            <div class="flex gap-x-1.5 items-center">
                <h1 class="font-jomhuria font-bold text-xl text-black">Login</h1>
                <i data-feather="user" width="25" height="25" class="text-black font-bold"></i>
            </div>
            <p class="font-outfit font-normal">Salamat datang di <span class="font-outfit font-semibold">BULIKAKAN</span></p>
        </div>

        <div class="mt-2 flex flex-col justify-center items-center">
            <img src="{{ asset('logo/loop-nobg.png') }}" width="210" alt="logo bulikakan">
            <h2 class="font-jomhuria font-bold text-biruPrimary">Masukkan Akun Anda</h2>
        </div>

        <form action="#" method="POST" class="mt-4">
            @csrf
            <div class="mb-2">
                <input
                    type="email"
                    name="email"
                    id="email"
                    required
                    placeholder="Email Anda"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-md shadow-gray-300 focus:ring focus:ring-blue-200 focus:outline-none font-jomhuria placeholder-abuPlaceholder"
                    style="box-shadow: inset 0 4px 6px -4px rgba(0, 0, 0, 0.3), 0 4px 6px -1px rgba(0, 0, 0, 0.1);"
                >
            </div>
            <div x-data="{ show: false }" class="mb-2 relative">
                <input
                    :type="show ? 'text' : 'password'"
                    name="password"
                    id="password"
                    required
                    placeholder="Kata Sandi"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-md focus:ring focus:ring-blue-200 focus:outline-none font-jomhuria placeholder-abuPlaceholder"
                    style="box-shadow: inset 0 4px 6px -4px rgba(0, 0, 0, 0.3), 0 4px 6px -1px rgba(0, 0, 0, 0.1);"
                >
                <span
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 cursor-pointer"
                    @click="show = !show; $nextTick(() => feather.replace())"
                    x-html="show ? feather.icons['eye-off'].toSvg({ width: '16', height: '16' }) : feather.icons['eye'].toSvg({ width: '16', height: '16' })"
                >
                </span>
            </div>
            

            <div class="w-full flex justify-end">
                <a href="{{ route('forgotPassword') }}">
                    <p class="font-jomhuria font-normal text-sm text-abuForgot">Lupa Password?</p>
                </a>
            </div>

            <div class="flex justify-center mt-4">
                <button type="submit"
                    class="bg-biruPrimary text-white px-6 py-2 w-full rounded-md hover:bg-blue-600 transition duration-200 font-semibold font-jomhuria">
                    Login
                </button>
            </div>
        </form>

        <div class="flex items-center justify-center my-4">
            <hr class="w-1/4 border-gray-300">
            <span class="mx-2 text-gray-500 text-sm font-jomhuria">Atau Login Dengan</span>
            <hr class="w-1/4 border-gray-300">
        </div>
        
        <div class="flex justify-center mb-4">
            <a href="#" class="flex items-center gap-2 px-4 py-2 rounded-md shadow hover:shadow-md transition duration-200">
                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" class="w-5 h-5">
                <span class="font-jomhuria text-sm text-gray-700">Google</span>
            </a>
        </div>
        
        <div class="text-center">
            <p class="text-sm font-jomhuria text-gray-600">Belum punya akun? 
                <a href="{{ route('register') }}" class="text-biruPrimary font-semibold hover:underline">Daftar</a>
            </p>
        </div>
    </div>
</div>
@endsection
