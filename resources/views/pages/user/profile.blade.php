<x-app-layout>
    <div class="flex flex-col w-full items-center justify-center">
        @guest
            <div class="flex flex-col items-center mt-8">
                <img src="{{ asset('logo/loop-nobg.png') }}" width="210" alt="logo bulikakan">
                <h1 class="-mt-8 font-bold font-jomhuria text-3xl text-biruPrimary">BULIKAKAN</h1>
                <h2 class="font-jomhuria text-sm mt-4">Silahkan Login / Register Terlebih Dahulu</h2>
                <div class="flex gap-x-5 mt-2">
                    <a class="bg-biruPrimary text-white px-4 py-2 w-24 text-center rounded-md font-semibold font-jomhuria"
                        href="{{ route('login') }}">Login</a>
                    <a class="bg-biruPrimary text-white px-4 py-2 w-24 text-center rounded-md font-semibold font-jomhuria"
                        href="{{ route('register') }}">Register</a>
                </div>
            </div>
        @endguest

        @auth
            <div class="w-full flex flex-col items-center mt-8">
                <img class="w-28"
                    src="https://avataaars.io/?avatarStyle=Circle&topType=ShortHairShortFlat&accessoriesType=Blank&hairColor=Blonde&facialHairType=Blank&clotheType=BlazerShirt&eyeType=Happy&eyebrowType=Default&mouthType=Smile&skinColor=Light"
                    alt="Avatar" />
                <h3 class="font-semibold text-xl mt-1.5">{{ Auth::user()->username }}</h3>
                <h4 class="font-normal text-lg">{{ Auth::user()->email }}</h4>
                <a href="#" class="text-xs text-biruPrimary mt-1.5">Edit Profile</a>
            </div>

            <div x-data="{ tab: 'kehilangan' }" class="w-full mt-6 p-4 max-w-6xl">
                <!-- Tabs -->
                <div class="flex gap-x-3 justify-center border-b border-gray-300 mb-4">
                    <button @click="tab = 'kehilangan'"
                        :class="tab === 'kehilangan' ? 'bg-biruPrimary text-white border-b-4 border-abuForgot' : 'bg-gray-100 text-biruPrimary border-b-4 border-transparent'"
                        class="text-sm font-semibold py-1.5 px-4 rounded-t-md">Kehilangan</button>
                    <button @click="tab = 'penemuan'"
                        :class="tab === 'penemuan' ? 'bg-biruPrimary text-white border-b-4 border-abuForgot' : 'bg-gray-100 text-biruPrimary border-b-4 border-transparent'"
                        class="text-sm font-semibold py-1.5 px-4 rounded-t-md">Penemuan</button>
                </div>

                <!-- Kehilangan -->
                <div x-show="tab === 'kehilangan'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ([1, 2, 3, 4, 5, 6] as $index) {{-- Ganti array ini dengan data asli nanti --}}
                        @php
                            $isEven = $loop->iteration % 2 === 0;
                            $bgClass = $isEven ? 'bg-biruPrimary text-white' : 'bg-gray-200 text-black';
                        @endphp

                        <div class="{{ $bgClass }} shadow-md rounded-xl flex gap-3 p-3">
                            <img src="{{ asset('logo/barang1.png') }}" class="w-32 h-32 object-cover rounded"
                                alt="Barang Hilang">
                            <div class="flex flex-col justify-between">
                                <div>
                                    <h3 class="text-lg font-bold">Dompet Hilang</h3>
                                    <p class="text-sm"><strong>Waktu:</strong> 15 Juni 2025</p>
                                    <p class="text-sm"><strong>Tempat:</strong> Pasar Lama Banjarmasin</p>
                                    <p class="text-sm"><strong>Tipe:</strong> Barang Pribadi</p>
                                </div>
                                <a href="#" class="text-xs {{ $isEven ? 'text-white' : 'text-biruPrimary' }} underline">Lihat
                                    Detail</a>
                            </div>
                        </div>
                    @endforeach
                </div>


                <!-- Penemuan -->
                <div x-show="tab === 'penemuan'" x-cloak class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                    @foreach ([1, 2, 3, 4, 5,6] as $index) {{-- Ganti array ini dengan data penemuan --}}
                        @php
                            $isEven = $loop->iteration % 2 === 0;
                            $bgClass = $isEven ? 'bg-gray-200 text-black' : 'bg-biruPrimary text-white';
                        @endphp

                        <div class="{{ $bgClass }} shadow-md rounded-xl flex gap-3 p-3">
                            <img src="{{ asset('logo/barang1.png') }}" class="w-32 h-32 object-cover rounded"
                                alt="Barang Ditemukan">
                            <div class="flex flex-col justify-between">
                                <div>
                                    <h3 class="text-lg font-bold">Kunci Motor</h3>
                                    <p class="text-sm"><strong>Waktu:</strong> 18 Juni 2025</p>
                                    <p class="text-sm"><strong>Tempat:</strong> Taman Kamboja</p>
                                    <p class="text-sm"><strong>Tipe:</strong> Aksesoris</p>
                                </div>
                                <a href="#" class="text-xs {{ $isEven ? 'text-biruPrimary' : 'text-white' }} underline">Lihat
                                    Detail</a>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        @endauth
    </div>
</x-app-layout>