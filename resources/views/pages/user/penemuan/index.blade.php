<x-app-layout title="Penemuan">
    <div class="flex flex-col w-full">
        <!-- Header -->
        <div class="flex w-full justify-center gap-x-2 mb-4">
            <h2 class="font-jomhuria font-semibold text-xl text-biruPrimary text-center">Informasi Penemuan</h2>
            <img src="{{ asset('logo/icon-find.png') }}" class="w-5" alt="icon-penemuan">
        </div>

        <!-- Form Search + Filter + Tambah -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6 px-4">
            <form method="GET" action="{{ route('penemuan') }}"
                class="flex flex-col md:flex-row justify-between items-center gap-4 w-full">
                <!-- Search -->
                <input type="text" name="search" placeholder="Cari barang ditemukan..." value="{{ request('search') }}"
                    class="w-full md:w-1/2 p-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-biruPrimary">

                <!-- Tipe -->
                <select name="tipe"
                    class="w-full md:w-1/4 p-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-biruPrimary">
                    <option value="">Semua Tipe</option>
                    @foreach ($tipeBarangs as $tipe)
                        <option value="{{ $tipe->nama }}" {{ request('tipe') == $tipe->nama ? 'selected' : '' }}>
                            {{ $tipe->nama }}
                        </option>
                    @endforeach
                </select>
            </form>

            <!-- Tambah -->
            @auth
                <a href="{{ route('penemuan.create') }}"
                    class="w-full md:w-auto text-center bg-biruPrimary text-white px-4 py-2 rounded-xl font-semibold text-sm whitespace-nowrap">
                    Tambah
                </a>
            @else
                <button data-modal-target="login-alert-modal" data-modal-toggle="login-alert-modal"
                    class="w-full md:w-auto text-center cursor-pointer bg-biruPrimary text-white px-4 py-2 rounded-xl font-semibold text-sm whitespace-nowrap">
                    Tambah
                </button>
            @endauth
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 px-4">
            @forelse ($penemuan as $index => $item)
                <div
                    class="{{ $index % 2 === 0 ? 'bg-biruPrimary text-white' : 'bg-gray-200 text-black' }} shadow-md rounded-xl flex gap-3 p-3">
                    <div class="relative">
                        <img src="{{ $item['image'] }}" class="w-32 h-32 object-cover rounded" alt="Barang Hilang">

                        @if($item['selesai'])
                            <div
                                class="absolute top-0 left-0 w-full h-full bg-black/20 flex items-center justify-center rounded">
                                <div class="bg-gray-800/80 p-1 rounded-lg shadow text-white text-[10px] font-bold text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-auto mb-0.5 text-biruPrimary"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    SELESAI
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-bold" title="{{ $item['nama'] }}">
                                {{ \Illuminate\Support\Str::limit($item['nama'], 10) }}
                            </h3>
                            <p class="text-sm"><strong>Waktu:</strong> {{ $item['waktu'] }}</p>
                            <p class="text-sm"><strong>Tempat:</strong> {{ $item['tempat'] }}</p>
                            <p class="text-sm"><strong>Tipe:</strong> {{ $item['tipe'] }}</p>
                            <p class="text-sm flex items-center gap-1">
                                <strong>Diposting oleh:</strong> {{ $item['user_name'] }}
                                @if ($item['is_official'])
                                    <svg class="w-5 h-5 currentColor" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.5283 1.5999C11.7686 1.29437 12.2314 1.29437 12.4717 1.5999L14.2805 3.90051C14.4309 4.09173 14.6818 4.17325 14.9158 4.10693L17.7314 3.3089C18.1054 3.20292 18.4799 3.475 18.4946 3.86338L18.6057 6.78783C18.615 7.03089 18.77 7.24433 18.9984 7.32823L21.7453 8.33761C22.1101 8.47166 22.2532 8.91189 22.0368 9.23478L20.4078 11.666C20.2724 11.8681 20.2724 12.1319 20.4078 12.334L22.0368 14.7652C22.2532 15.0881 22.1101 15.5283 21.7453 15.6624L18.9984 16.6718C18.77 16.7557 18.615 16.9691 18.6057 17.2122L18.4946 20.1366C18.4799 20.525 18.1054 20.7971 17.7314 20.6911L14.9158 19.8931C14.6818 19.8267 14.4309 19.9083 14.2805 20.0995L12.4717 22.4001C12.2314 22.7056 11.7686 22.7056 11.5283 22.4001L9.71949 20.0995C9.56915 19.9083 9.31823 19.8267 9.08421 19.8931L6.26856 20.6911C5.89463 20.7971 5.52014 20.525 5.50539 20.1366L5.39427 17.2122C5.38503 16.9691 5.22996 16.7557 5.00164 16.6718L2.25467 15.6624C1.88986 15.5283 1.74682 15.0881 1.96317 14.7652L3.59221 12.334C3.72761 12.1319 3.72761 11.8681 3.59221 11.666L1.96317 9.23478C1.74682 8.91189 1.88986 8.47166 2.25467 8.33761L5.00165 7.32823C5.22996 7.24433 5.38503 7.03089 5.39427 6.78783L5.50539 3.86338C5.52014 3.475 5.89463 3.20292 6.26857 3.3089L9.08421 4.10693C9.31823 4.17325 9.56915 4.09173 9.71949 3.90051L11.5283 1.5999Z"
                                            stroke="currentColor" stroke-width="1.5" />
                                        <path d="M9 12L11 14L15 10" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                @endif
                            </p>
                        </div>
                        <a href="{{ url('/penemuan-detail/' . $item['id']) }}"
                            class="text-xs underline {{ $index % 2 === 0 ? 'text-white' : 'text-biruPrimary' }}">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500 italic py-8">
                    Tidak ada hasil ditemukan.
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="px-4 mt-6 flex justify-center">
            {{ $penemuan->links('vendor.pagination.flowbite') }}
        </div>
    </div>

    {{-- Modal login --}}
    <div id="login-alert-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div class="bg-white rounded-xl p-6 w-80 shadow-lg text-center relative">
            <button type="button" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 focus:outline-none"
                data-modal-hide="login-alert-modal">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <h2 class="text-lg font-bold text-gray-800 mb-2">Login Diperlukan</h2>
            <p class="text-sm text-gray-600 mb-4">Anda harus login terlebih dahulu untuk mengakses fitur ini.</p>
            <div class="flex justify-center gap-3">
                <button type="button" data-modal-hide="login-alert-modal"
                    class="px-4 py-1 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                    Tutup
                </button>
                <a href="{{ route('login') }}"
                    class="px-4 py-1 bg-biruPrimary text-white rounded hover:bg-biruPrimary/90">Login</a>
            </div>
        </div>
    </div>

    {{-- Modal gagal --}}
    @if (session('create_failed') || $errors->any())
        <div id="failed-modal" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="bg-white rounded-xl p-6 w-80 shadow-lg text-center relative">
                <button type="button" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600"
                    data-modal-hide="failed-modal">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <h2 class="text-lg font-bold text-red-600 mb-2">Gagal Menyimpan</h2>
                @if (session('create_failed'))
                    <p class="text-sm text-gray-600 mb-2">{{ session('create_failed') }}</p>
                @endif
                @if ($errors->any())
                    <ul class="text-sm text-left text-red-500 list-disc list-inside mb-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <button type="button" data-modal-hide="failed-modal"
                    class="px-4 py-1 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                    Tutup
                </button>
            </div>
        </div>
    @endif

 
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[data-modal-hide]').forEach(button => {
                button.addEventListener('click', function () {
                    const modalId = button.getAttribute('data-modal-hide');
                    const modalElement = document.getElementById(modalId) || button.closest('.fixed');
                    if (modalElement) {
                        modalElement.classList.add('hidden');
                    }
                });
            });

            const searchInput = document.querySelector('input[name="search"]');
            const selectFilter = document.querySelector('select[name="tipe"]');
            const form = searchInput.closest('form');

            function submitForm() {
                form.submit();
            }

            searchInput.addEventListener('input', function () {
                clearTimeout(this._timeout);
                this._timeout = setTimeout(submitForm, 500); 
            });

            selectFilter.addEventListener('change', submitForm);
        });

        @if (session('create_failed') || $errors->any())
            document.addEventListener('DOMContentLoaded', () => {
                const modal = document.getElementById('failed-modal');
                if (modal) modal.classList.remove('hidden');
            });
        @endif
    </script>
</x-app-layout>