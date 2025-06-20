<x-app-layout title="Password Baru">
<div class="relative">
    <!-- Quarter circle top-right -->
    <div class="absolute -top-5 right-0 w-52 h-52 bg-biruCircleShapes rounded-bl-full z-0"></div>

    <div class="relative z-10 px-2">
        <div class="mt-5 ml-2 flex flex-col gap-y-1.5">
            <div class="flex gap-x-1.5 items-center">
                <a href="{{ route('forgotPassword') }}" class="" style="box-shadow: 0 2px 4px rgba(232, 236, 244, 0.6);">
                    <i data-feather="chevron-left" width="25" height="25" class="text-black font-bold"></i>
                </a>
                <h1 class="font-jomhuria font-bold text-xl text-black">Password Baru</h1>
            </div>
            <p class="font-outfit font-normal md:pl-7">Masukkan Password Baru Anda <br> Yang Berbeda Dengan Password Sebelumnya</p>
        </div>

        <div class="mt-2 flex flex-col justify-center items-center">
            <img src="{{ asset('logo/loop-nobg.png') }}" width="210" alt="logo bulikakan">
            <h2 class="font-jomhuria font-bold text-biruPrimary">Masukkan Password Baru Anda</h2>
        </div>

        <form action="{{ route('password.update') }}" method="POST" class="mt-4 flex justify-center" x-data="{ password: '', password_confirmation: '', showPassword: false, showConfirmPassword: false }">
            @csrf
             <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">
            <div class="w-full max-w-lg">
            <!-- Password Field with Show/Hide Toggle -->
            <div x-data="{ show: false }" class="mb-2 relative">
                <input
                    :type="show ? 'text' : 'password'"
                    x-model="password"
                    name="password"
                    id="password"
                    required
                    placeholder="Password Baru"
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

            <!-- Confirm Password Field with Show/Hide Toggle and Validation -->
            <div x-data="{ show: false }" class="mb-2 relative">
                <input
                    :type="show ? 'text' : 'password'"
                    x-model="password_confirmation"
                    :class="{'border-red-500': password_confirmation && password_confirmation !== password}"
                    name="password_confirmation"
                    id="password_confirmation"
                    required
                    placeholder="Konfirmasi Password"
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

            <!-- Submit Button -->
            <div class="flex justify-center mt-4">
                <button type="submit"
                    class="bg-biruPrimary text-white px-6 py-2 w-full rounded-md hover:bg-blue-600 transition duration-200 font-semibold font-jomhuria">
                    Reset Password
                </button>
            </div>
            </div>
        </form>

    </div>
</div>
</x-app-layout>
