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
                    <img src="{{ $item['image'] }}" class="w-32 h-32 object-cover rounded" alt="Barang Ditemukan">
                    <div class="flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-bold">{{ $item['nama'] }}</h3>
                            <p class="text-sm"><strong>Waktu:</strong> {{ $item['waktu'] }}</p>
                            <p class="text-sm"><strong>Tempat:</strong> {{ $item['tempat'] }}</p>
                            <p class="text-sm"><strong>Tipe:</strong> {{ $item['tipe'] }}</p>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
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

    {{-- Script untuk modal & search realtime --}}
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
                this._timeout = setTimeout(submitForm, 500); // debounce 500ms
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
