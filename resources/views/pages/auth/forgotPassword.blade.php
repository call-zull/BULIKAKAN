<x-app-layout title="Lupa Password">
    <div class="relative">
        <!-- Quarter circle top-right -->
        <div class="absolute -top-5 right-0 w-52 h-52 bg-biruCircleShapes rounded-bl-full z-0"></div>

        <div class="relative z-10 px-2">
            <div class="mt-5 ml-2 flex flex-col gap-y-1.5">
                <div class="flex gap-x-1.5 items-center">
                    <a href="{{ route('login') }}" class="" style="box-shadow: 0 2px 4px rgba(232, 236, 244, 0.6);">
                        <i data-feather="chevron-left" width="25" height="25" class="text-black font-bold"></i>
                    </a>
                    <h1 class="font-jomhuria font-bold text-xl text-black">Lupa Password</h1>
                </div>
                <p class="font-outfit md:pl-7 font-normal">Jangan Khawatir, Cukup Masukkan Email Yang Terhubung Dengan Akun Anda</p>
            </div>

            <div class="mt-2 flex flex-col justify-center items-center">
                <img src="{{ asset('logo/loop-nobg.png') }}" width="210" alt="logo bulikakan">
                <h2 class="font-jomhuria font-bold text-biruPrimary">Masukkan Email Anda</h2>
            </div>

            <form action="#" method="POST" class="mt-4 flex justify-center">
                @csrf
                <div class="w-full max-w-lg">
                    <div class="mb-2">
                        <input type="email" name="email" id="email" required placeholder="Email Anda"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-md shadow-gray-300 focus:ring focus:ring-blue-200 focus:outline-none font-jomhuria placeholder-abuPlaceholder"
                            style="box-shadow: inset 0 4px 6px -4px rgba(0, 0, 0, 0.3), 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                    </div>

                    <div class="flex justify-center mt-4">
                        <button type="submit"
                            class="bg-biruPrimary text-white px-6 py-2 w-full rounded-md hover:bg-blue-600 transition duration-200 font-semibold font-jomhuria">
                            Kirim
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
