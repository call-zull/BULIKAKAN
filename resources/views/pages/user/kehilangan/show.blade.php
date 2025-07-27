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

            {{-- <img
                src="{{ $pengumuman->foto_barang ? asset('storage/' . $pengumuman->foto_barang) : asset('logo/barang1.png') }}"
                alt="Gambar Barang" class="w-full h-64 object-cover rounded mb-4"> --}}
            <!-- Di bagian gambar, tambahkan ini -->
            <div class="relative">
                <img src="{{ $pengumuman->foto_barang ? asset('storage/' . $pengumuman->foto_barang) : asset('logo/barang1.png') }}"
                    alt="Gambar Barang" class="w-full h-64 object-cover rounded mb-4">

                @if($pengumuman->selesai)
                    <div class="absolute top-0 left-0 w-full h-full bg-black/10 flex items-center justify-center">
                        <div class="bg-gray-800/80 bg-opacity-70 p-2 rounded-lg shadow-xl">
                            <div class="flex flex-col items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-biruPrimary" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="block text-center font-bold text-white text-base mt-1">SELESAI</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <h2 class="text-2xl font-bold text-biruPrimary mb-2">{{ $pengumuman->judul }}</h2>
            <p class="mb-1 flex items-center gap-1">
                <strong>Diposting oleh:</strong> {{ $pengumuman->user->username }}
                @if ($pengumuman->user->status_user === 'official')
                    <svg class="w-5 h-5 text-biruPrimary" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.5283 1.5999C11.7686 1.29437 12.2314 1.29437 12.4717 1.5999L14.2805 3.90051C14.4309 4.09173 14.6818 4.17325 14.9158 4.10693L17.7314 3.3089C18.1054 3.20292 18.4799 3.475 18.4946 3.86338L18.6057 6.78783C18.615 7.03089 18.77 7.24433 18.9984 7.32823L21.7453 8.33761C22.1101 8.47166 22.2532 8.91189 22.0368 9.23478L20.4078 11.666C20.2724 11.8681 20.2724 12.1319 20.4078 12.334L22.0368 14.7652C22.2532 15.0881 22.1101 15.5283 21.7453 15.6624L18.9984 16.6718C18.77 16.7557 18.615 16.9691 18.6057 17.2122L18.4946 20.1366C18.4799 20.525 18.1054 20.7971 17.7314 20.6911L14.9158 19.8931C14.6818 19.8267 14.4309 19.9083 14.2805 20.0995L12.4717 22.4001C12.2314 22.7056 11.7686 22.7056 11.5283 22.4001L9.71949 20.0995C9.56915 19.9083 9.31823 19.8267 9.08421 19.8931L6.26856 20.6911C5.89463 20.7971 5.52014 20.525 5.50539 20.1366L5.39427 17.2122C5.38503 16.9691 5.22996 16.7557 5.00164 16.6718L2.25467 15.6624C1.88986 15.5283 1.74682 15.0881 1.96317 14.7652L3.59221 12.334C3.72761 12.1319 3.72761 11.8681 3.59221 11.666L1.96317 9.23478C1.74682 8.91189 1.88986 8.47166 2.25467 8.33761L5.00165 7.32823C5.22996 7.24433 5.38503 7.03089 5.39427 6.78783L5.50539 3.86338C5.52014 3.475 5.89463 3.20292 6.26857 3.3089L9.08421 4.10693C9.31823 4.17325 9.56915 4.09173 9.71949 3.90051L11.5283 1.5999Z"
                            stroke="currentColor" stroke-width="1.5" />
                        <path d="M9 12L11 14L15 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                @endif
            </p>

            <p class="mb-1"><strong>Waktu Kehilangan:</strong>
                {{ \Carbon\Carbon::parse($pengumuman->waktu)->translatedFormat('d F Y') }}</p>
            {{-- <p class="mb-1"><strong>Tempat Kehilangan:</strong> {{ $pengumuman->tempat }}</p> --}}
            <p class="mb-1"><strong>Provinsi:</strong> {{ $pengumuman->provinsi ?? 'Belum tercantum' }}</p>
            <p class="mb-1"><strong>Kabupaten:</strong> {{ $pengumuman->kabupaten ?? 'Belum tercantum' }}</p>
            <p class="mb-1"><strong>Kecamatan:</strong> {{ $pengumuman->kecamatan ?? 'Belum tercantum' }}</p>
            <p class="mb-1"><strong>Kelurahan:</strong> {{ $pengumuman->kelurahan ?? 'Belum tercantum' }}</p>
            <p class="mb-1"><strong>Tempat Spesifik:</strong> {{ $pengumuman->tempat ?? 'Belum tercantum' }}</p>

            <p class="mb-1"><strong>Tipe Barang:</strong> {{ $pengumuman->tipeBarang->nama ?? 'Tidak diketahui' }}</p>
            <p class="mb-1"><strong>Deskripsi:</strong> {!! nl2br(e($pengumuman->deskripsi)) !!}</p>
            <p class="mb-4"><strong>Kontak:</strong> {{ $pengumuman->kontak }}</p>
            <!-- Tombol Kembali & Bagikan -->
            <div class="flex justify-between items-center mt-6" x-data="{ open: false }">
                <a href="{{ url()->previous() }}"
                    class="bg-biruPrimary text-white px-4 cursor-pointer py-2 rounded-lg text-sm hover:bg-opacity-90 transition">
                    ← Kembali
                </a>

                <button @click="open = true"
                    class="bg-borderAbu text-biruPrimary px-4 py-2 rounded-lg text-sm cursor-pointer">
                    🔗 Bagikan
                </button>

                <!-- Modal -->
                <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center " x-transition>
                    <div @click.away="open = false" class="bg-white rounded-lg p-6 w-full max-w-sm shadow-lg">
                        <h2 class="text-lg font-semibold mb-4 text-center">Bagikan Pengumuman Ini</h2>

                        @php
                            $shareUrl = urlencode(route('kehilangan.show', $pengumuman->id));
                            $shareText = urlencode("Saya kehilangan barang tolong jika mengetahui atau menemukan mohon diinfokan : {$pengumuman->judul}. Lihat di sini:");
                        @endphp

                        <div class="grid grid-cols-2 gap-3">
                            <a href="https://wa.me/?text={{ $shareText }}%20{{ $shareUrl }}" target="_blank"
                                class="bg-green-500 text-white px-4 py-2 rounded flex items-center justify-center gap-x-1  hover:bg-green-600 transition text-center">
                                <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    id="Whatsapp--Streamline-Unicons" height="20" width="20">
                                    <desc>
                                        Whatsapp Streamline Icon: https://streamlinehq.com
                                    </desc>
                                    <path
                                        d="M14.54825 11.96975c-0.19575 -0.09783333333333334 -1.4681666666666668 -0.6850833333333334 -1.6639166666666667 -0.783 -0.19575 -0.09783333333333334 -0.3915 -0.09783333333333334 -0.58725 0.09791666666666667s-0.5873333333333334 0.783 -0.7830833333333334 0.9787500000000001c-0.09783333333333334 0.19575 -0.29358333333333336 0.19575 -0.4893333333333334 0.09783333333333334 -0.6851666666666667 -0.29358333333333336 -1.3703333333333334 -0.6850833333333334 -1.9575833333333335 -1.1745 -0.4894166666666667 -0.4894166666666667 -0.9787500000000001 -1.0766666666666667 -1.3702500000000002 -1.6639166666666667 -0.09791666666666667 -0.19575 0 -0.3915 0.09783333333333334 -0.4894166666666667 0.09791666666666667 -0.09783333333333334 0.19575 -0.29358333333333336 0.3915 -0.3915 0.09791666666666667 -0.09783333333333334 0.19575 -0.29358333333333336 0.19575 -0.3915 0.09791666666666667 -0.09783333333333334 0.09791666666666667 -0.29358333333333336 0 -0.3915 -0.09783333333333334 -0.09783333333333334 -0.58725 -1.2724166666666668 -0.783 -1.7618333333333334 -0.09783333333333334 -0.6850833333333334 -0.2936666666666667 -0.6850833333333334 -0.4894166666666667 -0.6850833333333334h-0.4893333333333334c-0.19575 0 -0.4894166666666667 0.19575 -0.5873333333333334 0.29358333333333336 -0.58725 0.5873333333333334 -0.8808333333333334 1.2724166666666668 -0.8808333333333334 2.0555000000000003 0.09783333333333334 0.8808333333333334 0.3915 1.7617500000000001 0.9787500000000001 2.54475 1.0766666666666667 1.5660833333333333 2.446916666666667 2.8385000000000002 4.110833333333334 3.6214999999999997 0.4894166666666667 0.19575 0.8809166666666667 0.3915 1.3703333333333334 0.4894166666666667 0.4893333333333334 0.19575 0.9787500000000001 0.19575 1.566 0.09783333333333334 0.6851666666666667 -0.09783333333333334 1.2724166666666668 -0.58725 1.6639166666666667 -1.1745 0.19575 -0.3915 0.19575 -0.783 0.09791666666666667 -1.1745833333333333l-0.3915 -0.19575Zm2.446916666666667 -8.906833333333333c-3.8172500000000005 -3.8172500000000005 -9.983500000000001 -3.8172500000000005 -13.80075 0C0.06233333333333334 6.195 -0.5249166666666667 10.991 1.6284166666666666 14.808250000000001L0.25808333333333333 19.8l5.1875 -1.3702500000000002c1.4681666666666668 0.783 3.03425 1.1745 4.60025 1.1745 5.383333333333334 0 9.689916666666667 -4.306583333333334 9.689916666666667 -9.689916666666667 0.09791666666666667 -2.5448333333333335 -0.9787500000000001 -4.991750000000001 -2.7405833333333334 -6.851416666666667ZM14.3525 16.765833333333333c-1.2724166666666668 0.783 -2.7405833333333334 1.2723333333333333 -4.306666666666667 1.2723333333333333 -1.4681666666666668 0 -2.838416666666667 -0.3915 -4.110833333333334 -1.0765833333333334l-0.2936666666666667 -0.19583333333333333 -3.0341666666666667 0.7830833333333334 0.783 -2.9363333333333337 -0.19575 -0.2936666666666667C0.8453333333333334 10.40375 2.019916666666667 5.509833333333333 5.837166666666667 3.0629166666666667 9.654333333333334 0.616 14.54825 1.8884166666666666 16.897333333333336 5.60775c2.349 3.8171666666666666 1.2724166666666668 8.809000000000001 -2.5448333333333335 11.158Z"
                                        fill="#FFFFFF" stroke-width="0.8333"></path>
                                </svg>
                                <span>
                                    WhatsApp
                                </span>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank"
                                class="bg-blue-600 text-white px-4 py-2 rounded flex items-center justify-center gap-x-1 hover:bg-blue-700 transition text-center">
                                <i data-feather="facebook" width="20" height="20"></i>
                                <span>Facebook</span>
                            </a>
                            <a href="{{ asset('storage/' . $pengumuman->foto_barang) }}" download
                                class="bg-violet-500 text-white px-4 py-2 rounded hover:bg-violet-600 transition text-center">
                                📥 Gambar
                            </a>
                            <button onclick="copyCaption()"
                                class="bg-biruPrimary cursor-pointer text-white px-4 py-2 rounded text-center">
                                ✍️ Salin Caption
                            </button>


                            <div class="col-span-2 flex justify-center">
                                <button
                                    onclick="navigator.clipboard.writeText('{{ $shareUrl }}'); alert('Tautan berhasil disalin!')"
                                    class="bg-gray-500 cursor-pointer text-white px-4 py-2 rounded hover:bg-gray-600 transition text-center">
                                    🔗 Salin Tautan
                                </button>
                            </div>
                        </div>


                        <!-- Tombol Tutup -->
                        <div class="mt-4 text-center">
                            <button @click="open = false"
                                class="text-sm cursor-pointer text-gray-600 hover:text-gray-800">
                                ✖ Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function copyCaption() {
            const caption = `Saya kehilangan barang: {{ $pengumuman->judul }}.\n\nCek info lengkapnya di:\n{{ route('kehilangan.show', $pengumuman->id) }}\n\nMohon bantuannya 🙏🏼`;
            navigator.clipboard.writeText(caption).then(() => {
                alert("Caption berhasil disalin! Silakan tempel dimana anda mau.");
            });
        }
    </script>
</x-app-layout>