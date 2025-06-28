<x-app-layout title="Tambah Penemuan">
    <div class="flex flex-col w-full">
        <!-- Header -->
        <div class="flex w-full justify-center items-center gap-x-2 mb-6">
            <h2 class="font-jomhuria font-semibold text-xl text-biruPrimary text-center">Tambah Pengumuman Penemuan</h2>
            <img src="{{ asset('logo/icon-find.png') }}" class="w-5" alt="icon-penemuan">
        </div>

        <!-- Form Card -->
        <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-2xl p-6 border border-gray-200">
            <form action="{{ route('penemuan.store') }}" method="POST" enctype="multipart/form-data"
                class="flex flex-col md:flex-row gap-6" x-data="{ preview: null }">
                @csrf
                <input type="hidden" name="jenis_pengumuman" value="penemuan">

                <!-- Left: Image Upload -->
                <div class="w-full md:w-1/2">
                    <label class="block mb-2 font-medium text-biruPrimary">Foto Barang</label>

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
                        <label class="block mb-1 font-medium text-biruPrimary">Waktu Ditemukan</label>
                        <input type="datetime-local" name="waktu" required
                            class="w-full p-2 border border-gray-300 rounded-xl focus:ring-biruPrimary focus:outline-none">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-biruPrimary">Tempat Ditemukan</label>
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
