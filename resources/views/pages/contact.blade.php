<x-app-layout title="Contact Kami">
    <div class="max-w-4xl mx-auto p-6 bg-white shadow rounded-xl">
        <h1 class="text-2xl font-bold text-biruPrimary mb-4">Contact Kami Via Email</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('contact.send') }}" enctype="multipart/form-data" id="contact-form">
            @csrf

            <div class="mb-4">
                <label class="block font-medium text-biruPrimary">Judul</label>
                <input type="text" name="judul" value="{{ old('judul') }}"
                    class="w-full border border-gray-300 rounded p-2 focus:ring focus:ring-biruPrimary focus:outline-none">
                @error('judul')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium text-biruPrimary">Pesan</label>
                <textarea name="pesan" rows="5"
                    class="w-full border border-gray-300 rounded p-2 focus:ring focus:ring-biruPrimary focus:outline-none">{{ old('pesan') }}</textarea>
                @error('pesan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium text-biruPrimary">Gambar (Opsional)</label>
                <input type="file" name="gambar"
                    class="w-full border border-gray-300 rounded p-2 focus:ring focus:ring-biruPrimary focus:outline-none">
                @error('gambar')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            @auth
                <button type="submit"
                    class="bg-biruPrimary cursor-pointer text-white font-semibold px-4 py-2 rounded hover:bg-opacity-90 transition">
                    Kirim Pesan
                </button>
            @endauth

            @guest
                <button type="button"
                    onclick="showModal()"
                    class="bg-biruPrimary cursor-pointer text-white font-semibold px-4 py-2 rounded hover:bg-opacity-90 transition">
                    Kirim Pesan
                </button>
            @endguest
        </form>
    </div>

    {{-- Modal Login --}}
    <div id="login-alert-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div class="bg-white rounded-xl p-4 w-72 shadow-xl text-center relative">
            <!-- Tombol Close -->
            <button type="button" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 focus:outline-none"
                onclick="hideModal()">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <h2 class="text-lg font-bold text-gray-800 mb-2">Login Diperlukan</h2>
            <p class="text-sm text-gray-600 mb-4">Anda harus login terlebih dahulu untuk mengakses fitur ini.</p>
            <div class="flex justify-center gap-3">
                <button type="button" onclick="hideModal()"
                    class="px-4 py-1 bg-gray-300 cursor-pointer text-gray-800 rounded hover:bg-gray-400">
                    Tutup
                </button>
                <a href="{{ route('login') }}"
                    class="px-4 py-1 bg-biruPrimary cursor-pointer text-white rounded hover:bg-biruPrimary/90">Login</a>
            </div>
        </div>
    </div>

    {{-- Modal Script --}}
    <script>
        function showModal() {
            document.getElementById('login-alert-modal').classList.remove('hidden');
        }

        function hideModal() {
            document.getElementById('login-alert-modal').classList.add('hidden');
        }
    </script>
</x-app-layout>
