<x-app-layout title="Tambah Kehilangan">
    <div class="flex flex-col w-full">
        <!-- Header -->
        <div class="flex w-full justify-center items-center gap-x-2 mb-6">
            <h2 class="font-jomhuria font-semibold text-xl text-biruPrimary text-center">Tambah Pengumuman Kehilangan
            </h2>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14" class="w-5" stroke="#4682B4">
                <path d="M11.5 4h-9c-1.1 0-2 .9-2 2v5.5c0 1.1.9 2 2 2h9c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2Z" />
                <path d="M4.5 4v-.5a2.5 2.5 0 0 1 5 0V4" />
                <path d="M5.5 7.5a1.5 1.5 0 0 1 3 0c0 .8-.7 1-1.5 1v.5" />
                <path d="M7 11.5a.25.25 0 1 1 0-.5.25.25 0 1 1 0 .5Z" />
            </svg>
        </div>

        <!-- Form Card -->
        <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-2xl p-6 border border-gray-200">
            <form action="{{ route('kehilangan.store') }}" method="POST" enctype="multipart/form-data"
                class="flex flex-col md:flex-row gap-6" x-data="{ preview: null, showModalGambar: false }">
                @csrf
                <input type="hidden" name="jenis_pengumuman" value="kehilangan">

                <!-- Left: Image Upload -->
                <div class="w-full md:w-1/2">
                    <label class="block mb-2 font-medium text-biruPrimary">Foto Barang</label>
                    <label class="block text-center bg-biruPrimary text-white px-4 py-2 rounded-xl cursor-pointer hover:bg-opacity-90">
    Pilih dari Kamera / Galeri
    <input type="file" name="foto_barang" accept="image/*" capture="environment" required
        class="hidden"
        @change="preview = URL.createObjectURL($event.target.files[0]); showModalGambar = false">
</label>


                    {{-- <label
                        class="w-full flex items-center justify-center px-4 py-2 bg-biruPrimary text-white rounded-xl cursor-pointer hover:bg-opacity-90">
                        Pilih Gambar
                        <input type="file" name="foto_barang" accept="image/*" class="hidden"
                            @change="preview = URL.createObjectURL($event.target.files[0])">
                    </label> --}}
                    <!-- Tombol Pilih Gambar -->
                  <!-- Tombol Pilih Gambar -->
{{-- <button type="button" @click="showModalGambar = true"
    class="px-4 py-2 bg-biruPrimary cursor-pointer text-white rounded-xl hover:bg-opacity-90">
    Pilih dari Kamera / Galeri
</button>

<!-- Modal -->
<div x-show="showModalGambar" @click.away="showModalGambar = false"
    class="fixed inset-0 flex items-center justify-center bg-transparent z-50">
    <div class="bg-white p-6 rounded-xl space-y-4">
        <p class="text-lg font-semibold text-gray-700">Pilih Sumber Gambar</p>

        <!-- Kamera -->
        <label
            class="block cursor-pointer text-center bg-biruPrimary text-white px-4 py-2 rounded-xl hover:bg-opacity-90">
            Gunakan Kamera
            <input type="file" name="foto_barang" accept="image/*" capture="environment"
                class="hidden"
                @change="preview = URL.createObjectURL($event.target.files[0]); showModalGambar = false">
        </label>

        <!-- Galeri -->
        <label
            class="block cursor-pointer text-center bg-emerald-600 text-white px-4 py-2 rounded-xl hover:bg-opacity-90">
            Pilih dari Galeri
            <input type="file" name="foto_barang" accept="image/*"
                class="hidden"
                @change="preview = URL.createObjectURL($event.target.files[0]); showModalGambar = false">
        </label>
    </div>
</div> --}}



                    <template x-if="preview">
                        <div class="mt-4 rounded-xl border border-gray-300 overflow-hidden">
                            <img :src="preview" alt="Preview" class="w-full h-64 object-contain" />
                        </div>
                    </template>
                </div>

                <!-- Right: Fields -->
                <div class="w-full md:w-1/2 space-y-4">
                    <div>
                        <label class="block mb-1 font-medium text-biruPrimary">Judul</label>
                        <input type="text" name="judul"
                            class="w-full p-2 border border-gray-300 rounded-xl focus:ring-biruPrimary focus:outline-none">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-biruPrimary">Waktu Kehilangan</label>
                        <input type="datetime-local" name="waktu"
                            class="w-full p-2 border border-gray-300 rounded-xl focus:ring-biruPrimary focus:outline-none">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-biruPrimary">Tempat Kehilangan</label>
                        <input type="text" name="tempat"
                            class="w-full p-2 border border-gray-300 rounded-xl focus:ring-biruPrimary focus:outline-none">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-biruPrimary">Deskripsi</label>
                        <textarea name="deskripsi" rows="3"
                            class="w-full p-2 border border-gray-300 rounded-xl focus:ring-biruPrimary focus:outline-none"></textarea>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-biruPrimary">Kontak yang Dapat Dihubungi</label>
                        <input type="text" name="kontak"
                            class="w-full p-2 border border-gray-300 rounded-xl focus:ring-biruPrimary focus:outline-none">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-biruPrimary">Tipe Barang</label>
                        <select name="tipe_barang_id"
                            class="w-full p-2 border border-gray-300 rounded-xl focus:ring-biruPrimary focus:outline-none">
                            <option value="">-- Pilih Tipe Barang --</option>
                            @foreach ($tipeBarangs as $tipe)
                                <option value="{{ $tipe->id }}">{{ $tipe->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-center pt-2">
                        <button type="submit"
                            class="bg-biruPrimary cursor-pointer text-white px-6 py-2 rounded-xl font-semibold hover:bg-opacity-90 transition duration-150">
                            Simpan Pengumuman
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Error --}}
    @if (session('create_failed') || $errors->any())
        <div x-data="{ show: true }" x-show="show" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="bg-white rounded-xl p-6 w-96 shadow-lg text-center relative">
                <button @click="show = false" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <h2 class="text-lg font-bold text-red-600 mb-2">Gagal Menyimpan</h2>

                @if ($errors->any())
                    <ul class="text-sm text-left text-red-500 list-disc list-inside mb-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @elseif (session('create_failed'))
                    <p class="text-sm text-gray-600 mb-2">{{ session('create_failed') }}</p>
                @endif


                <button @click="show = false" class="px-4 py-1 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                    Tutup
                </button>
            </div>
        </div>
    @endif

</x-app-layout>