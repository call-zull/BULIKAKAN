<x-app-layout title="Kehilangan">
    <div class="flex flex-col w-full" x-data="kehilanganFilter()">
        <!-- Header + Icon -->
        <div class="flex w-full justify-center gap-x-2 mb-4">
            <h2 class="font-jomhuria font-semibold text-xl text-biruPrimary text-center">Informasi Kehilangan</h2>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14" id="Lost-And-Found--Streamline-Core"
                class="w-5">
                <g id="lost-and-found">
                    <path stroke="#4682B4" stroke-linecap="round" stroke-linejoin="round"
                        d="M11.5 4h-9c-1.10457 0 -2 0.89543 -2 2v5.5c0 1.1046 0.89543 2 2 2h9c1.1046 0 2 -0.8954 2 -2V6c0 -1.10457 -0.8954 -2 -2 -2Z"
                        stroke-width="1" />
                    <path stroke="#4682B4" stroke-linecap="round" stroke-linejoin="round"
                        d="M4.5 4v-0.5c0 -0.66304 0.26339 -1.29893 0.73223 -1.76777C5.70107 1.26339 6.33696 1 7 1c0.66304 0 1.29893 0.26339 1.76777 0.73223C9.23661 2.20107 9.5 2.83696 9.5 3.5V4"
                        stroke-width="1" />
                    <path stroke="#4682B4" stroke-linecap="round" stroke-linejoin="round"
                        d="M5.5 7.5c0 -0.29667 0.08797 -0.58668 0.2528 -0.83335 0.16482 -0.24668 0.39909 -0.43894 0.67317 -0.55247 0.27409 -0.11353 0.57569 -0.14324 0.86667 -0.08536 0.29097 0.05788 0.55824 0.20074 0.76802 0.41052 0.20978 0.20978 0.35264 0.47705 0.41052 0.76803 0.05788 0.29097 0.02817 0.59257 -0.08536 0.86666 -0.11353 0.27409 -0.30579 0.50835 -0.55246 0.67318C7.58668 8.91203 7.29667 9 7 9v0.5"
                        stroke-width="1" />
                    <g>
                        <path stroke="#4682B4" stroke-linecap="round" stroke-linejoin="round"
                            d="M7.00195 11.5c-0.13807 0 -0.25 -0.1119 -0.25 -0.25s0.11193 -0.25 0.25 -0.25"
                            stroke-width="1" />
                        <path stroke="#4682B4" stroke-linecap="round" stroke-linejoin="round"
                            d="M7.00195 11.5c0.13807 0 0.25 -0.1119 0.25 -0.25s-0.11193 -0.25 -0.25 -0.25"
                            stroke-width="1" />
                    </g>
                </g>
            </svg>
        </div>

        <!-- Search & Filter Controls + Tombol Tambah -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6 px-4">
            @auth
                <a href="{{ route('kehilangan.create') }}"
                    class="w-full md:w-auto text-center bg-biruPrimary text-white px-4 py-2 rounded-xl font-semibold text-sm">
                    Tambah
                </a>
            @else
                <button data-modal-target="login-alert-modal" data-modal-toggle="login-alert-modal"
                    class="w-full md:w-auto text-center cursor-pointer bg-biruPrimary text-white px-4 py-2 rounded-xl font-semibold text-sm">
                    Tambah
                </button>

            @endauth

            <!-- Form Pencarian -->
            <input type="text" placeholder="Cari barang hilang..." x-model="search"
                class="w-full md:w-1/2 p-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-biruPrimary">

            <!-- Select Tipe -->
            <select x-model="selectedType"
                class="w-full md:w-1/4 p-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-biruPrimary">
                <option value="">Semua Tipe</option>
                <option value="Barang Pribadi">Barang Pribadi</option>
                <option value="Dokumen">Dokumen</option>
                <option value="Elektronik">Elektronik</option>
            </select>
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 px-4">
            <template x-for="(item, index) in filteredItems" :key="item.id">
                <div :class="index % 2 === 0 
        ? 'bg-biruPrimary text-white' 
        : 'bg-gray-200 text-black'" class="shadow-md rounded-xl flex gap-3 p-3">
                    <img :src="item.image" class="w-32 h-32 object-cover rounded" alt="Barang Hilang">
                    <div class="flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-bold" x-text="item.nama"></h3>
                            <p class="text-sm"><strong>Waktu:</strong> <span x-text="item.waktu"></span></p>
                            <p class="text-sm"><strong>Tempat:</strong> <span x-text="item.tempat"></span></p>
                            <p class="text-sm"><strong>Tipe:</strong> <span x-text="item.tipe"></span></p>
                        </div>
                        <a :href="`/kehilangan-detail/${item.id}`"
                            :class="index % 2 === 0 ? 'text-white' : 'text-biruPrimary'" class="text-xs underline">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </template>

        </div>

        <!-- No result -->
        <div x-show="filteredItems.length === 0" class="text-center text-gray-500 italic py-8">
            Tidak ada hasil ditemukan.
        </div>
    </div>
    <!-- Modal: Harus Login Dulu -->
    <div id="login-alert-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div class="bg-white rounded-xl p-6 w-80 shadow-lg text-center relative">
            <!-- Close Button -->
            <button type="button" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 focus:outline-none"
                data-modal-hide="login-alert-modal">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>

            <!-- Modal Content -->
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

{{-- Modal: Gagal --}}
@if (session('create_failed') || $errors->any())
    <div id="failed-modal" tabindex="-1" aria-hidden="true"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div class="bg-white rounded-xl p-6 w-80 shadow-lg text-center relative">
            <button type="button" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600"
                data-modal-hide="failed-modal">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
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

@if (session('create_failed') || $errors->any())
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('failed-modal');
            if (modal) modal.classList.remove('hidden');
        });
    </script>
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
    });
</script>



    <!-- Alpine JS -->
    <script>
        function kehilanganFilter() {
            return {
                search: '',
                selectedType: '',
                items: @json($kehilangan),
                get filteredItems() {
                    return this.items.filter(item => {
                        const matchSearch = item.nama.toLowerCase().includes(this.search.toLowerCase());
                        const matchType = this.selectedType === '' || item.tipe === this.selectedType;
                        return matchSearch && matchType;
                    });
                }
            }
        }

    </script>

</x-app-layout>