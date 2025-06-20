<x-app-layout title="Detail Kehilangan">
    <div class="flex flex-col w-full px-4 py-6" x-data="kehilanganDetail()">
        <!-- Header -->
        <div class="flex justify-center gap-x-2 mb-6">
            <h2 class="font-jomhuria font-semibold text-xl text-biruPrimary text-center">Detail Informasi Kehilangan</h2>
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

        <!-- Detail Card -->
        <template x-if="item">
            <div class="bg-white shadow-md rounded-xl p-6 max-w-3xl mx-auto">
                <img :src="item.image" alt="Gambar Barang" class="w-full h-64 object-cover rounded mb-4">
                <h2 class="text-2xl font-bold text-biruPrimary mb-2" x-text="item.nama"></h2>
                <p class="mb-1"><strong>Waktu Kehilangan:</strong> <span x-text="item.waktu"></span></p>
                <p class="mb-1"><strong>Tempat Kehilangan:</strong> <span x-text="item.tempat"></span></p>
                <p class="mb-4"><strong>Tipe Barang:</strong> <span x-text="item.tipe"></span></p>
                <a href="# class="inline-block bg-biruPrimary text-white px-4 py-2 rounded-lg text-sm">← Kembali</a>
            </div>
        </template>

        <div x-show="!item" class="text-center text-red-500 mt-10">Data tidak ditemukan.</div>
    </div>

    <script>
        function kehilanganDetail() {
            const urlParams = new URLSearchParams(window.location.search);
            const id = parseInt(urlParams.get('id'));

            const items = [
                {
                    id: 1,
                    nama: 'Dompet Hilang',
                    waktu: '15 Juni 2025',
                    tempat: 'Pasar Lama Banjarmasin',
                    tipe: 'Barang Pribadi',
                    image: '{{ asset("logo/barang1.png") }}'
                },
                {
                    id: 2,
                    nama: 'KTP Hilang',
                    waktu: '14 Juni 2025',
                    tempat: 'Terminal Pal 6',
                    tipe: 'Dokumen',
                    image: '{{ asset("logo/barang1.png") }}'
                },
                {
                    id: 3,
                    nama: 'Handphone Hilang',
                    waktu: '13 Juni 2025',
                    tempat: 'Duta Mall Banjarmasin',
                    tipe: 'Elektronik',
                    image: '{{ asset("logo/barang1.png") }}'
                },
            ];

            return {
                item: items.find(i => i.id === id)
            }
        }
    </script>
</x-app-layout>
