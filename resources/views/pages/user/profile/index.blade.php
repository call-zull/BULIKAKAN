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
                        @php
            $photoPath = Auth::user()->profile_photo
                ? asset('storage/' . Auth::user()->profile_photo)
                : 'https://avataaars.io/?avatarStyle=Circle&topType=ShortHairShortFlat&accessoriesType=Blank&hairColor=Blonde&facialHairType=Blank&clotheType=BlazerShirt&eyeType=Happy&eyebrowType=Default&mouthType=Smile&skinColor=Light';
                        @endphp

                        <img class="w-28 h-28 rounded-full object-cover" src="{{ $photoPath }}" alt="Foto Profil" />
                        <h3 class="font-semibold text-xl mt-1.5 flex items-center gap-1">
                            {{ Auth::user()->username }}
                            @if (Auth::user()->isOfficial())
                                {{-- <img src="{{ asset('logo/official.svg') }}" alt="Official" class="w-5 text-biruPrimary h-5"> --}}
                                <svg class="w-5 h-5 text-biruPrimary" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.5283 1.5999C11.7686 1.29437 12.2314 1.29437 12.4717 1.5999L14.2805 3.90051C14.4309 4.09173 14.6818 4.17325 14.9158 4.10693L17.7314 3.3089C18.1054 3.20292 18.4799 3.475 18.4946 3.86338L18.6057 6.78783C18.615 7.03089 18.77 7.24433 18.9984 7.32823L21.7453 8.33761C22.1101 8.47166 22.2532 8.91189 22.0368 9.23478L20.4078 11.666C20.2724 11.8681 20.2724 12.1319 20.4078 12.334L22.0368 14.7652C22.2532 15.0881 22.1101 15.5283 21.7453 15.6624L18.9984 16.6718C18.77 16.7557 18.615 16.9691 18.6057 17.2122L18.4946 20.1366C18.4799 20.525 18.1054 20.7971 17.7314 20.6911L14.9158 19.8931C14.6818 19.8267 14.4309 19.9083 14.2805 20.0995L12.4717 22.4001C12.2314 22.7056 11.7686 22.7056 11.5283 22.4001L9.71949 20.0995C9.56915 19.9083 9.31823 19.8267 9.08421 19.8931L6.26856 20.6911C5.89463 20.7971 5.52014 20.525 5.50539 20.1366L5.39427 17.2122C5.38503 16.9691 5.22996 16.7557 5.00164 16.6718L2.25467 15.6624C1.88986 15.5283 1.74682 15.0881 1.96317 14.7652L3.59221 12.334C3.72761 12.1319 3.72761 11.8681 3.59221 11.666L1.96317 9.23478C1.74682 8.91189 1.88986 8.47166 2.25467 8.33761L5.00165 7.32823C5.22996 7.24433 5.38503 7.03089 5.39427 6.78783L5.50539 3.86338C5.52014 3.475 5.89463 3.20292 6.26857 3.3089L9.08421 4.10693C9.31823 4.17325 9.56915 4.09173 9.71949 3.90051L11.5283 1.5999Z"
                                        stroke="currentColor" stroke-width="1.5" />
                                    <path d="M9 12L11 14L15 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>

                            @endif

                        </h3>
                        <h4 class="font-normal text-lg">{{ Auth::user()->email }}</h4>
                        <a href="{{ route('profile.edit') }}" class="text-xs text-biruPrimary mt-1.5">Edit Profile</a>
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
                            @forelse ($kehilangan as $item)
                                                @php
                                $isEven = $loop->iteration % 2 === 0;
                                $bgClass = $isEven ? 'bg-biruPrimary text-white' : 'bg-gray-200 text-black';
                                                @endphp

                                                <div class="{{ $bgClass }} shadow-md rounded-xl flex gap-3 p-3">
                                                    <img src="{{ $item->foto_barang_url }}" class="w-32 h-32 object-cover rounded" alt="Foto Barang">
                                                    <div class="flex flex-col justify-between">
                                                        <div>
                                                            <h3 class="text-lg font-bold" title="{{ $item->judul }}">
                                                                {{ \Illuminate\Support\Str::limit($item->judul, 10) }}
                                                            </h3>
                                                            <p class="text-sm"><strong>Waktu:</strong> {{ $item->waktu->translatedFormat('d F Y') }}</p>
                                                            <p class="text-sm"><strong>Tempat:</strong> {{ $item->tempat }}</p>
                                                            <p class="text-sm"><strong>Tipe:</strong> {{ $item->tipeBarang->nama ?? '-' }}</p>
                                                        </div>
                                                        <a href="{{ route('kehilangan.show', $item->id) }}"
                                                            class="text-xs underline {{ $isEven ? 'text-white' : 'text-biruPrimary' }}">
                                                            Lihat Detail
                                                        </a>
                                                    </div>
                                                </div>
                            @empty
                                <p class="col-span-3 text-center text-sm text-gray-500">Belum ada data kehilangan.</p>
                            @endforelse


                        </div>


                        <!-- Penemuan -->
                        <div x-show="tab === 'penemuan'" x-cloak class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                            @forelse ($penemuan as $item)
                                @php
                $isEven = $loop->iteration % 2 === 0;
                $bgClass = $isEven ? 'bg-gray-200 text-black' : 'bg-biruPrimary text-white';
                                @endphp

                                <div class="{{ $bgClass }} shadow-md rounded-xl flex gap-3 p-3">
                                    <img src="{{ $item->foto_barang_url }}" class="w-32 h-32 object-cover rounded" alt="Foto Barang">
                                    <div class="flex flex-col justify-between">
                                        <div>
                                            <h3 class="text-lg font-bold">{{ $item->judul }}</h3>
                                            <p class="text-sm"><strong>Waktu:</strong> {{ $item->waktu->translatedFormat('d F Y') }}</p>
                                            <p class="text-sm"><strong>Tempat:</strong> {{ $item->tempat }}</p>
                                            <p class="text-sm"><strong>Tipe:</strong> {{ $item->tipeBarang->nama ?? '-' }}</p>
                                        </div>
                                        <a href="{{ route('penemuan.show', $item->id) }}"
                                            class="text-xs underline {{ $isEven ? 'text-biruPrimary' : 'text-white' }}">
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <p class="col-span-3 text-center text-sm text-gray-500">Belum ada data penemuan.</p>
                            @endforelse

                        </div>

                    </div>
        @endauth
    </div>
</x-app-layout>