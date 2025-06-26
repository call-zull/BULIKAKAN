<x-app-layout title="Tambah Kehilangan">
    <div class="flex flex-col w-full">
        <!-- Header -->
        <div class="flex w-full justify-center items-center gap-x-2 mb-6">
            <h2 class="font-jomhuria font-semibold text-xl text-biruPrimary text-center">Tambah Pengumuman Kehilangan</h2>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14" class="w-5" stroke="#4682B4">
                <g>
                    <path d="M11.5 4h-9c-1.1 0-2 .9-2 2v5.5c0 1.1.9 2 2 2h9c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2Z" />
                    <path d="M4.5 4v-.5a2.5 2.5 0 0 1 5 0V4" />
                    <path d="M5.5 7.5a1.5 1.5 0 0 1 3 0c0 .8-.7 1-1.5 1v.5" />
                    <path d="M7 11.5a.25.25 0 1 1 0-.5.25.25 0 1 1 0 .5Z" />
                </g>
            </svg>
        </div>

        <!-- Form Card -->
        <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-2xl p-6 border border-gray-200">
            <form action="{{ route('kehilangan.store') }}" method="POST" enctype="multipart/form-data"
                class="flex flex-col md:flex-row gap-6" x-data="{ preview: null }">
                @csrf
                <input type="hidden" name="jenis_pengumuman" value="kehilangan">

                <!-- Left: Image Upload -->
                <div class="w-full md:w-1/2">
                    <label class="block mb-2 font-medium text-biruPrimary">Foto Barang</label>

                    <!-- Custom file input -->
                    <label class="w-full flex items-center justify-center px-4 py-2 bg-biruPrimary text-white rounded-xl cursor-pointer hover:bg-opacity-90">
                        Pilih Gambar
                        <input type="file" name="foto_barang" accept="image/*"
                            class="hidden"
                            @change="preview = URL.createObjectURL($event.target.files[0])">
                    </label>

                    <template x-if="preview">
                        <div class="mt-4 rounded-xl border border-gray-300 overflow-hidden">
                            <img :src="preview" alt="Preview" class="w-full h-64 object-contain" />
                        </div>
                    </template>
                </div>

                <!-- Right: Form Fields -->
                <div class="w-full md:w-1/2 space-y-4">
                    <div>
                        <label class="block mb-1 font-medium text-biruPrimary">Judul</label>
                        <input type="text" name="judul" required
                            class="w-full p-2 border border-gray-300 rounded-xl focus:ring-biruPrimary focus:outline-none">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-biruPrimary">Waktu Kehilangan</label>
                        <input type="datetime-local" name="waktu" required
                            class="w-full p-2 border border-gray-300 rounded-xl focus:ring-biruPrimary focus:outline-none">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-biruPrimary">Tempat Kehilangan</label>
                        <input type="text" name="tempat" required
                            class="w-full p-2 border border-gray-300 rounded-xl focus:ring-biruPrimary focus:outline-none">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-biruPrimary">Deskripsi</label>
                        <textarea name="deskripsi" rows="3"
                            class="w-full p-2 border border-gray-300 rounded-xl focus:ring-biruPrimary focus:outline-none"></textarea>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-biruPrimary">Kontak yang Dapat Dihubungi</label>
                        <input type="text" name="kontak" required
                            class="w-full p-2 border border-gray-300 rounded-xl focus:ring-biruPrimary focus:outline-none">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-biruPrimary">Tipe Barang</label>
                        <select name="tipe_barang_id" required
                            class="w-full p-2 border border-gray-300 rounded-xl focus:ring-biruPrimary focus:outline-none">
                            <option value="">-- Pilih Tipe Barang --</option>
                            @foreach ($tipeBarangs as $tipe)
                                <option value="{{ $tipe->id }}">{{ $tipe->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status hanya untuk admin -->
                    @if(auth()->user()?->role === 'admin')
                        <div>
                            <label class="block mb-1 font-medium text-biruPrimary">Status</label>
                            <select name="status"
                                class="w-full p-2 border border-gray-300 rounded-xl focus:ring-biruPrimary focus:outline-none">
                                <option value="publish">Publish</option>
                                <option value="takedown">Takedown</option>
                            </select>
                        </div>
                    @endif

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
</x-app-layout>
