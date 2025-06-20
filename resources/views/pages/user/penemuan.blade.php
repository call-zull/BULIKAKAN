<x-app-layout title="Penemuan">
    <div class="flex flex-col w-full" x-data="penemuanFilter()">
        <!-- Judul -->
        <div class="flex w-full justify-center mb-4 gap-x-2">
            <h2 class="font-jomhuria font-semibold text-xl text-biruPrimary text-center">Informasi Penemuan</h2>
            <img src="{{ asset('logo/icon-find.png') }}" class="w-5" alt="icon-kehilangan">
        </div>

        <!-- Search & Filter Controls + Tombol Tambah -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6 px-4">
             <a href="#"
                class="w-full md:w-auto text-center bg-biruPrimary text-white px-4 py-2 rounded-xl font-semibold text-sm ">
                Tambah 
            </a>
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

        <!-- Grid Container -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 px-4">
            <!-- Loop Card -->
            <template x-for="item in filteredItems" :key="item.id">
                <div class="bg-gray-200 shadow-md rounded-xl flex gap-3 p-3">
                    <img :src="item.image" class="w-32 h-32 object-cover rounded" alt="Barang Ditemukan">
                    <div class="flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-bold" x-text="item.nama"></h3>
                            <p class="text-sm"><strong>Waktu:</strong> <span x-text="item.waktu"></span></p>
                            <p class="text-sm"><strong>Tempat:</strong> <span x-text="item.tempat"></span></p>
                            <p class="text-sm"><strong>Tipe:</strong> <span x-text="item.tipe"></span></p>
                        </div>
                        <a href="#" class="text-xs text-biruPrimary underline">Lihat Detail</a>
                    </div>
                </div>
            </template>
        </div>

        <!-- Tidak ada hasil -->
        <div x-show="filteredItems.length === 0" class="text-center text-gray-500 italic py-8">
            Tidak ada hasil ditemukan.
        </div>
    </div>

    <!-- Alpine.js Script -->
    <script>
        function penemuanFilter() {
            return {
                search: '',
                selectedType: '',
                items: [
                    {
                        id: 1,
                        nama: 'Dompet Ditemukan',
                        waktu: '16 Juni 2025',
                        tempat: 'Taman Siring Banjarmasin',
                        tipe: 'Barang Pribadi',
                        image: '{{ asset("logo/barang1.png") }}'
                    },
                    {
                        id: 2,
                        nama: 'Kunci Motor Ditemukan',
                        waktu: '14 Juni 2025',
                        tempat: 'Kampus ULM',
                        tipe: 'Kunci',
                        image: '{{ asset("logo/barang1.png") }}'
                    },
                    {
                        id: 3,
                        nama: 'HP Ditemukan',
                        waktu: '13 Juni 2025',
                        tempat: 'Duta Mall Banjarmasin',
                        tipe: 'Elektronik',
                        image: '{{ asset("logo/barang1.png") }}'
                    },
                    // Tambahkan data lainnya jika perlu
                ],
                get filteredItems() {
                    return this.items.filter(item => {
                        const matchesSearch = item.nama.toLowerCase().includes(this.search.toLowerCase());
                        const matchesType = this.selectedType === '' || item.tipe === this.selectedType;
                        return matchesSearch && matchesType;
                    });
                }
            }
        }
    </script>
</x-app-layout>
 