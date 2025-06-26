<x-dashboard>
    <div class="px-4 py-6" x-data="{ showDetails: false }" x-init="$nextTick(() => showDetails = true)">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard Admin</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 transition-all duration-700 ease-in-out" x-show="showDetails" x-transition>
            <!-- Card -->
            <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:-translate-y-1">
                <div class="text-gray-500 text-sm mb-2">Total Pengumuman</div>
                <div class="text-3xl font-bold text-biruPrimary">{{ $totalPengumuman }}</div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:-translate-y-1">
                <div class="text-gray-500 text-sm mb-2">Pengumuman Kehilangan</div>
                <div class="text-3xl font-bold text-red-500">{{ $totalKehilangan }}</div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:-translate-y-1">
                <div class="text-gray-500 text-sm mb-2">Pengumuman Penemuan</div>
                <div class="text-3xl font-bold text-green-500">{{ $totalPenemuan }}</div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:-translate-y-1">
                <div class="text-gray-500 text-sm mb-2">Jumlah Pengguna</div>
                <div class="text-3xl font-bold text-indigo-500">{{ $totalUser }}</div>
            </div>
        </div>

        <!-- Collapsible Detail -->
        <div class="mt-8">
            <button @click="showDetails = !showDetails"
                class="px-4 py-2 bg-biruPrimary text-white rounded-xl font-semibold hover:bg-blue-700 transition">
                <span x-text="showDetails ? 'Sembunyikan Detail' : 'Tampilkan Detail'"></span>
            </button>
        </div>
    </div>
</x-dashboard>
