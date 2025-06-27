<x-app-layout title="Detail Kehilangan">
    <div class="flex flex-col w-full px-4">
        <!-- Header -->
        <div class="flex justify-center gap-x-2 mb-6">
            <h2 class="font-jomhuria font-semibold text-xl text-biruPrimary text-center">Detail Informasi Kehilangan
            </h2>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14" class="w-5">
                <path stroke="#4682B4" stroke-linecap="round" stroke-linejoin="round"
                    d="M11.5 4h-9c-1.1 0-2 0.9-2 2v5.5c0 1.1 0.9 2 2 2h9c1.1 0 2-0.9 2-2V6c0-1.1-0.9-2-2-2Z"
                    stroke-width="1" />
                <path stroke="#4682B4" stroke-linecap="round" stroke-linejoin="round"
                    d="M4.5 4v-0.5c0-0.66 0.26-1.3 0.73-1.77C5.7 1.26 6.34 1 7 1s1.3 0.26 1.77 0.73C9.24 2.2 9.5 2.84 9.5 3.5V4"
                    stroke-width="1" />
                <path stroke="#4682B4" stroke-linecap="round" stroke-linejoin="round"
                    d="M5.5 7.5c0-0.3 0.09-0.59 0.25-0.83 0.17-0.25 0.4-0.44 0.67-0.55 0.27-0.11 0.58-0.14 0.87-0.09 0.29 0.06 0.56 0.2 0.77 0.41 0.21 0.21 0.35 0.48 0.41 0.77 0.06 0.29 0.03 0.59-0.09 0.87-0.11 0.27-0.31 0.51-0.55 0.67C7.59 8.91 7.3 9 7 9v0.5"
                    stroke-width="1" />
                <circle cx="7" cy="11.25" r="0.25" fill="#4682B4" />
            </svg>
        </div>

        <!-- Detail Card -->
        <div class="bg-white shadow-md rounded-xl p-6 max-w-3xl mx-auto">
            @auth
                @if (auth()->user()->id === $pengumuman->user_id || auth()->user()->role === 'admin')

                    <div class="flex justify-between items-center mb-2" x-data="{ confirmDelete: false }">
                        <!-- Tombol Edit -->
                        <a href="{{ route('kehilangan.edit', $pengumuman->id) }}"
                            class="text-orange-600 flex items-center gap-1 text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.232 5.232l3.536 3.536M9 11l6.586-6.586a2 2 0 112.828 2.828L11.828 13.828a2 2 0 01-.707.465l-4 1a1 1 0 01-1.263-1.263l1-4a2 2 0 01.465-.707z" />
                            </svg>
                            Edit
                        </a>

                        <!-- Tombol Hapus -->
                        <button @click="confirmDelete = true"
                            class="text-red-600 cursor-pointer flex items-center gap-1 text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h10" />
                            </svg>
                            Hapus
                        </button>

                        <!-- Modal Konfirmasi Hapus -->
                        <div x-show="confirmDelete" x-transition x-cloak
                            :class="confirmDelete ? 'fixed inset-0 flex items-center justify-center z-50' : 'hidden'">
                            <div @click.away="confirmDelete = false" class="bg-white rounded-lg shadow-xl p-6 w-80">
                                <h2 class="text-lg font-semibold text-gray-800 mb-2">Konfirmasi Hapus</h2>
                                <p class="text-sm text-gray-600 mb-4">Apakah Anda yakin ingin menghapus pengumuman ini?</p>

                                <div class="flex justify-end gap-2">
                                    <button @click="confirmDelete = false"
                                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
                                        Batal
                                    </button>

                                    <form method="POST" action="{{ route('kehilangan.destroy', $pengumuman->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 bg-biruPrimary text-white rounded hover:bg-opacity-90 transition">
                                            Ya, Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>




                @endif
            @endauth

            <img src="{{ $pengumuman->foto_barang ? asset('storage/' . $pengumuman->foto_barang) : asset('logo/barang1.png') }}"
                alt="Gambar Barang" class="w-full h-64 object-cover rounded mb-4">
            <h2 class="text-2xl font-bold text-biruPrimary mb-2">{{ $pengumuman->judul }}</h2>
            <p class="mb-1"><strong>Waktu Kehilangan:</strong>
                {{ \Carbon\Carbon::parse($pengumuman->waktu)->translatedFormat('d F Y') }}</p>
            <p class="mb-1"><strong>Tempat Kehilangan:</strong> {{ $pengumuman->tempat }}</p>
            <p class="mb-1"><strong>Tipe Barang:</strong> {{ $pengumuman->tipeBarang->nama ?? 'Tidak diketahui' }}</p>
            <p class="mb-1"><strong>Deskripsi:</strong> {!! nl2br(e($pengumuman->deskripsi)) !!}</p>
            <p class="mb-4"><strong>Kontak:</strong> {{ $pengumuman->kontak }}</p>
            <a href="{{ url()->previous() }}"
                class="inline-block bg-biruPrimary text-white px-4 py-2 rounded-lg text-sm mt-4">← Kembali</a>

        </div>
    </div>
</x-app-layout>