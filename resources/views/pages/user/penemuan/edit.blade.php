<x-app-layout title="Edit Penemuan">
    <div class="flex flex-col w-full">
        <!-- Header -->
        <div class="flex w-full justify-center items-center gap-x-2 mb-6">
            <h2 class="font-jomhuria font-semibold text-xl text-biruPrimary text-center">Edit Informasi Penemuan</h2>
            <img src="{{ asset('logo/icon-find.png') }}" class="w-5" alt="icon-penemuan">
        </div>

        <!-- Form Card -->
        <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-2xl p-6 border border-gray-200">
            <form action="{{ route('penemuan.update', $pengumuman->id) }}" method="POST" enctype="multipart/form-data"
                class="flex flex-col md:flex-row gap-6" x-data="{ 
                    preview: null,
                    lokasi: lokasiSelector(),
                    init() {
                        this.lokasi.init();
                        // Set nilai awal untuk lokasi jika data sudah ada
                        if('{{ $pengumuman->provinsi }}') {
                            this.lokasi.provinsi_nama = '{{ $pengumuman->provinsi }}';
                            this.lokasi.kabupaten_nama = '{{ $pengumuman->kabupaten }}';
                            this.lokasi.kecamatan_nama = '{{ $pengumuman->kecamatan }}';
                            this.lokasi.kelurahan_id = '{{ $pengumuman->kelurahan }}';
                        }
                    }
                }">
                @csrf
                @method('PUT')
                <input type="hidden" name="jenis_pengumuman" value="penemuan">

                <!-- Left: Image Upload -->
                <div class="w-full md:w-1/2">
                    <label class="block mb-2 font-medium text-biruPrimary">Foto Barang</label>
                    <label
                        class="w-full flex items-center justify-center px-4 py-2 bg-biruPrimary text-white rounded-xl cursor-pointer hover:bg-opacity-90">
                        Pilih Gambar
                        <input type="file" name="foto_barang" accept=".jpeg,.jpg,.png" class="hidden"
                            @change="preview = URL.createObjectURL($event.target.files[0])">
                    </label>

                    <template x-if="preview">
                        <div class="mt-4 rounded-xl border border-gray-300 overflow-hidden">
                            <img :src="preview" alt="Preview" class="w-full h-64 object-contain" />
                        </div>
                    </template>

                    <template x-if="!preview">
                        <div class="mt-4 rounded-xl border border-gray-300 overflow-hidden">
                            <img src="{{ asset('storage/' . $pengumuman->foto_barang) }}" alt="Current Image"
                                class="w-full h-64 object-contain">
                        </div>
                    </template>
                </div>

                <!-- Right: Form Fields -->
                <div class="w-full md:w-1/2 space-y-4">
                    <div>
                        <label class="block mb-1 font-medium text-biruPrimary">Judul</label>
                        <input type="text" name="judul" value="{{ old('judul', $pengumuman->judul) }}" required
                            class="w-full p-2 border border-gray-300 rounded-xl focus:ring-biruPrimary focus:outline-none">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-biruPrimary">Waktu Ditemukan</label>
                        <input type="datetime-local" name="waktu"
                            value="{{ old('waktu', \Carbon\Carbon::parse($pengumuman->waktu)->format('Y-m-d\TH:i')) }}"
                            required
                            class="w-full p-2 border border-gray-300 rounded-xl focus:ring-biruPrimary focus:outline-none">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-biruPrimary">Deskripsi</label>
                        <textarea name="deskripsi" rows="3" required
                            class="w-full p-2 border border-gray-300 rounded-xl focus:ring-biruPrimary focus:outline-none">{{ old('deskripsi', $pengumuman->deskripsi) }}</textarea>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-biruPrimary">Kontak yang Dapat Dihubungi</label>
                        <input type="text" name="kontak" value="{{ old('kontak', $pengumuman->kontak) }}" required
                            class="w-full p-2 border border-gray-300 rounded-xl focus:ring-biruPrimary focus:outline-none">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-biruPrimary">Tipe Barang</label>
                        <select name="tipe_barang_id" required
                            class="w-full p-2 border border-gray-300 rounded-xl focus:ring-biruPrimary focus:outline-none">
                            <option value="">-- Pilih Tipe Barang --</option>
                            @foreach ($tipeBarangs as $tipe)
                                <option value="{{ $tipe->id }}"
                                    {{ old('tipe_barang_id', $pengumuman->tipe_barang_id) == $tipe->id ? 'selected' : '' }}>
                                    {{ $tipe->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-biruPrimary">Tempat Spesifik</label>
                        <input type="text" name="tempat" value="{{ old('tempat', $pengumuman->tempat) }}" required
                            class="w-full p-2 border border-gray-300 rounded-xl focus:ring-biruPrimary focus:outline-none">
                    </div>

                    <!-- Input Lokasi Wilayah -->
                    <div x-data="lokasi">
                        <div class="mb-2">
                            <label class="block mb-1 font-medium text-biruPrimary">Provinsi</label>
                            <select x-model="provinsi_id" @change="getKabupaten()"
                                class="w-full p-2 border border-gray-300 rounded-xl">
                                <option value="">-- Pilih Provinsi --</option>
                                <template x-for="prov in provinsi" :key="prov.id">
                                    <option :value="prov.id" x-text="prov.name" 
                                        :selected="prov.name === provinsi_nama"></option>
                                </template>
                            </select>
                        </div>

                        <div class="mb-2" x-show="kabupaten.length > 0">
                            <label class="block mb-1 font-medium text-biruPrimary">Kabupaten/Kota</label>
                            <select x-model="kabupaten_id" @change="getKecamatan()"
                                class="w-full p-2 border border-gray-300 rounded-xl">
                                <option value="">-- Pilih Kabupaten/Kota --</option>
                                <template x-for="kab in kabupaten" :key="kab.id">
                                    <option :value="kab.id" x-text="kab.name"
                                        :selected="kab.name === kabupaten_nama"></option>
                                </template>
                            </select>
                        </div>

                        <div class="mb-2" x-show="kecamatan.length > 0">
                            <label class="block mb-1 font-medium text-biruPrimary">Kecamatan</label>
                            <select x-model="kecamatan_id" @change="getKelurahan()"
                                class="w-full p-2 border border-gray-300 rounded-xl">
                                <option value="">-- Pilih Kecamatan --</option>
                                <template x-for="kec in kecamatan" :key="kec.id">
                                    <option :value="kec.id" x-text="kec.name"
                                        :selected="kec.name === kecamatan_nama"></option>
                                </template>
                            </select>
                        </div>

                        <div class="mb-4" x-show="kelurahan.length > 0">
                            <label class="block mb-1 font-medium text-biruPrimary">Kelurahan</label>
                            <select name="kelurahan" x-model="kelurahan_id"
                                class="w-full p-2 border border-gray-300 rounded-xl">
                                <option value="">-- Pilih Kelurahan --</option>
                                <template x-for="kel in kelurahan" :key="kel.id">
                                    <option :value="kel.name" x-text="kel.name"
                                        :selected="kel.name === kelurahan_id"></option>
                                </template>
                            </select>
                        </div>

                        <input type="hidden" name="provinsi" x-model="provinsi_nama">
                        <input type="hidden" name="kabupaten" x-model="kabupaten_nama">
                        <input type="hidden" name="kecamatan" x-model="kecamatan_nama">
                        <div>
    <label class="block mb-1 font-medium text-biruPrimary">Status Penyelesaian</label>
    <select name="selesai"
        class="w-full p-2 border border-gray-300 rounded-xl focus:ring-biruPrimary focus:outline-none">
        <option value="0" {{ !$pengumuman->selesai ? 'selected' : '' }}>Belum Selesai</option>
        <option value="1" {{ $pengumuman->selesai ? 'selected' : '' }}>Selesai/Dikembalikan</option>
    </select>
</div>
                    </div>

                    @if(auth()->user()?->role === 'admin')
                        <div>
                            <label class="block mb-1 font-medium text-biruPrimary">Status</label>
                            <select name="status"
                                class="w-full p-2 border border-gray-300 rounded-xl focus:ring-biruPrimary focus:outline-none">
                                <option value="publish" {{ $pengumuman->status === 'publish' ? 'selected' : '' }}>Publish</option>
                                <option value="takedown" {{ $pengumuman->status === 'takedown' ? 'selected' : '' }}>Takedown</option>
                            </select>
                        </div>
                    @endif

                    <div class="text-center pt-2">
                        <button type="submit"
                            class="bg-biruPrimary cursor-pointer text-white px-6 py-2 rounded-xl font-semibold hover:bg-opacity-90 transition duration-150">
                            Perbarui Pengumuman
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Error --}}
    @if (session('update_failed') || $errors->any())
        <div x-data="{ show: true }" x-show="show" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="bg-white rounded-xl p-6 w-96 shadow-lg text-center relative">
                <button @click="show = false" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <h2 class="text-lg font-bold text-red-600 mb-2">Gagal Memperbarui</h2>

                @if ($errors->any())
                    <ul class="text-sm text-left text-red-500 list-disc list-inside mb-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @elseif (session('update_failed'))
                    <p class="text-sm text-gray-600 mb-2">{{ session('update_failed') }}</p>
                @endif

                <button @click="show = false" class="px-4 py-1 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                    Tutup
                </button>
            </div>
        </div>
    @endif

    <script>
        function lokasiSelector() {
            return {
                provinsi: [],
                kabupaten: [],
                kecamatan: [],
                kelurahan: [],
                provinsi_id: '',
                kabupaten_id: '',
                kecamatan_id: '',
                kelurahan_id: '',
                provinsi_nama: '{{ $pengumuman->provinsi ?? '' }}',
                kabupaten_nama: '{{ $pengumuman->kabupaten ?? '' }}',
                kecamatan_nama: '{{ $pengumuman->kecamatan ?? '' }}',
                kelurahan_nama: '{{ $pengumuman->kelurahan ?? '' }}',

                async init() {
                    const res = await fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
                    this.provinsi = await res.json();
                    
                    // Jika ada data provinsi sebelumnya, load kabupaten
                    if(this.provinsi_nama) {
                        const prov = this.provinsi.find(p => p.name === this.provinsi_nama);
                        if(prov) {
                            this.provinsi_id = prov.id;
                            await this.getKabupaten();
                        }
                    }
                },

                async getKabupaten() {
                    this.kabupaten = [];
                    this.kecamatan = [];
                    this.kelurahan = [];
                    this.kabupaten_id = '';
                    this.kecamatan_id = '';
                    this.kelurahan_id = '';

                    const res = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${this.provinsi_id}.json`);
                    this.kabupaten = await res.json();
                    
                    // Jika ada data kabupaten sebelumnya, load kecamatan
                    if(this.kabupaten_nama) {
                        const kab = this.kabupaten.find(k => k.name === this.kabupaten_nama);
                        if(kab) {
                            this.kabupaten_id = kab.id;
                            await this.getKecamatan();
                        }
                    }
                },

                async getKecamatan() {
                    this.kecamatan = [];
                    this.kelurahan = [];
                    this.kecamatan_id = '';
                    this.kelurahan_id = '';

                    const res = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${this.kabupaten_id}.json`);
                    this.kecamatan = await res.json();
                    
                    // Jika ada data kecamatan sebelumnya, load kelurahan
                    if(this.kecamatan_nama) {
                        const kec = this.kecamatan.find(c => c.name === this.kecamatan_nama);
                        if(kec) {
                            this.kecamatan_id = kec.id;
                            await this.getKelurahan();
                        }
                    }
                },

                async getKelurahan() {
                    this.kelurahan = [];
                    this.kelurahan_id = '';

                    const res = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${this.kecamatan_id}.json`);
                    this.kelurahan = await res.json();
                    
                    // Set kelurahan_id setelah data kelurahan dimuat
                    if(this.kelurahan_nama) {
                        // Tunggu hingga render selesai
                        this.$nextTick(() => {
                            this.kelurahan_id = this.kelurahan_nama;
                        });
                    }
                }
            }
        }
    </script>
</x-app-layout>