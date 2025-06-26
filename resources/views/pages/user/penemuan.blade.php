<x-app-layout title="Penemuan">
    <div class="flex flex-col w-full" x-data="penemuanFilter()">
        <!-- Judul -->
        <div class="flex w-full justify-center mb-4 gap-x-2">
            <h2 class="font-jomhuria font-semibold text-xl text-biruPrimary text-center">Informasi Penemuan</h2>
            <img src="{{ asset('logo/icon-find.png') }}" class="w-5" alt="icon-penemuan">
        </div>

        <!-- Search & Filter Controls + Tombol Tambah -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6 px-4">
            <a href="#"
                class="w-full md:w-auto text-center bg-biruPrimary text-white px-4 py-2 rounded-xl font-semibold text-sm">
                Tambah 
            </a>
            <input type="text" placeholder="Cari barang ditemukan..." x-model="search"
                class="w-full md:w-1/2 p-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-biruPrimary">

            <select x-model="selectedType"
                class="w-full md:w-1/4 p-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-biruPrimary">
                <option value="">Semua Tipe</option>
                <option value="Barang Pribadi">Barang Pribadi</option>
                <option value="Dokumen">Dokumen</option>
                <option value="Elektronik">Elektronik</option>
                <option value="Aksesoris">Aksesoris</option>
                <option value="Kunci">Kunci</option>
            </select>
        </div>

        <!-- Grid Card -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 px-4">
            <template x-for="(item, index) in filteredItems" :key="item.id">
                <div :class="index % 2 === 0 
                        ? 'bg-biruPrimary text-white' 
                        : 'bg-gray-200 text-black'"
                    class="shadow-md rounded-xl flex gap-3 p-3">
                    <img :src="item.image" class="w-32 h-32 object-cover rounded" alt="Barang Ditemukan">
                    <div class="flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-bold" x-text="item.nama"></h3>
                            <p class="text-sm"><strong>Waktu:</strong> <span x-text="item.waktu"></span></p>
                            <p class="text-sm"><strong>Tempat:</strong> <span x-text="item.tempat"></span></p>
                            <p class="text-sm"><strong>Tipe:</strong> <span x-text="item.tipe"></span></p>
                        </div>
                        <a href="#" :class="index % 2 === 0 ? 'text-white' : 'text-biruPrimary'" class="text-xs underline">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </template>
        </div>

        <!-- Tidak ada hasil -->
        <div x-show="filteredItems.length === 0" class="text-center text-gray-500 italic py-8">
            Tidak ada hasil ditemukan.
        </div>
    </div>

    <!-- Alpine.js Logic -->
    <script>
        function penemuanFilter() {
            return {
                search: '',
                selectedType: '',
                items: [
                    { id: 1, nama: 'Dompet Ditemukan', waktu: '16 Juni 2025', tempat: 'Taman Siring Banjarmasin', tipe: 'Barang Pribadi', image: '{{ asset("logo/barang1.png") }}' },
                    { id: 2, nama: 'Kunci Motor', waktu: '14 Juni 2025', tempat: 'Kampus ULM', tipe: 'Kunci', image: '{{ asset("logo/barang1.png") }}' },
                    { id: 3, nama: 'HP Ditemukan', waktu: '13 Juni 2025', tempat: 'Duta Mall', tipe: 'Elektronik', image: '{{ asset("logo/barang1.png") }}' },
                    { id: 4, nama: 'KTP Tidak Bertuan', waktu: '12 Juni 2025', tempat: 'Masjid Sabilal', tipe: 'Dokumen', image: '{{ asset("logo/barang1.png") }}' },
                    { id: 5, nama: 'Jam Tangan Wanita', waktu: '11 Juni 2025', tempat: 'Stadion 17 Mei', tipe: 'Aksesoris', image: '{{ asset("logo/barang1.png") }}' },
                    { id: 6, nama: 'Payung Merah', waktu: '10 Juni 2025', tempat: 'Halte Bus', tipe: 'Barang Pribadi', image: '{{ asset("logo/barang1.png") }}' },
                    { id: 7, nama: 'Dompet Coklat', waktu: '9 Juni 2025', tempat: 'Lapangan Murjani', tipe: 'Barang Pribadi', image: '{{ asset("logo/barang1.png") }}' },
                    { id: 8, nama: 'Kacamata Hitam', waktu: '8 Juni 2025', tempat: 'Taman Kamboja', tipe: 'Aksesoris', image: '{{ asset("logo/barang1.png") }}' },
                    { id: 9, nama: 'Kartu ATM BRI', waktu: '7 Juni 2025', tempat: 'ATM BRI Gatot Subroto', tipe: 'Dokumen', image: '{{ asset("logo/barang1.png") }}' },
                    { id: 10, nama: 'Earphone Putih', waktu: '6 Juni 2025', tempat: 'Kampus Poliban', tipe: 'Elektronik', image: '{{ asset("logo/barang1.png") }}' },
                    { id: 11, nama: 'Buku Agenda', waktu: '5 Juni 2025', tempat: 'Perpustakaan Daerah', tipe: 'Dokumen', image: '{{ asset("logo/barang1.png") }}' },
                    { id: 12, nama: 'Topi Biru', waktu: '4 Juni 2025', tempat: 'Taman 0 Km Banjarmasin', tipe: 'Barang Pribadi', image: '{{ asset("logo/barang1.png") }}' },
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
