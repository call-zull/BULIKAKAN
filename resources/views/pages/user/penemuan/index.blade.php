<x-app-layout title="Penemuan">
    <div class="flex flex-col w-full" x-data="penemuanFilter()">
        <div class="flex w-full justify-center gap-x-2 mb-4">
            <h2 class="font-jomhuria font-semibold text-xl text-biruPrimary text-center">Informasi Penemuan</h2>
            <img src="{{ asset('logo/icon-find.png') }}" class="w-5" alt="icon-penemuan">
        </div>

        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6 px-4">
            @auth
                <a href="{{ route('penemuan.create') }}"
                    class="w-full md:w-auto text-center bg-biruPrimary text-white px-4 py-2 rounded-xl font-semibold text-sm">
                    Tambah
                </a>
            @else
                <button onclick="alert('Silakan login terlebih dahulu.'); window.location.href='{{ route('login') }}';"
                    class="w-full md:w-auto bg-biruPrimary text-white px-4 py-2 rounded-xl font-semibold text-sm">
                    Tambah
                </button>
            @endauth

            <input type="text" placeholder="Cari barang ditemukan..." x-model="search"
                class="w-full md:w-1/2 p-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-biruPrimary">

            <select x-model="selectedType"
                class="w-full md:w-1/4 p-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-biruPrimary">
                <option value="">Semua Tipe</option>
                <option value="Barang Pribadi">Barang Pribadi</option>
                <option value="Dokumen">Dokumen</option>
                <option value="Elektronik">Elektronik</option>
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 px-4">
            <template x-for="(item, index) in filteredItems" :key="item.id">
                <div :class="index % 2 === 0 
                        ? 'bg-biruPrimary text-white' 
                        : 'bg-gray-200 text-black'" class="shadow-md rounded-xl flex gap-3 p-3">
                    <img :src="item.image" class="w-32 h-32 object-cover rounded" alt="Barang Ditemukan">
                    <div class="flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-bold" x-text="item.nama"></h3>
                            <p class="text-sm"><strong>Waktu:</strong> <span x-text="item.waktu"></span></p>
                            <p class="text-sm"><strong>Tempat:</strong> <span x-text="item.tempat"></span></p>
                            <p class="text-sm"><strong>Tipe:</strong> <span x-text="item.tipe"></span></p>
                        </div>
                        <a :href="`/penemuan-detail/${item.id}`"
                            :class="index % 2 === 0 ? 'text-white' : 'text-biruPrimary'" class="text-xs underline">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </template>
        </div>

        <div x-show="filteredItems.length === 0" class="text-center text-gray-500 italic py-8">
            Tidak ada hasil ditemukan.
        </div>
    </div>

    <script>
        function penemuanFilter() {
            return {
                search: '',
                selectedType: '',
                items: @json($penemuan),
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
