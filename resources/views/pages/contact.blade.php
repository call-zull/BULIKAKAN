<x-app-layout title="Contact Kami">
    <div class="max-w-4xl mx-auto p-6 bg-white shadow rounded-xl">
        <h1 class="text-2xl font-bold text-biruPrimary mb-4">Contact Kami Via Email</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('contact.send') }}">
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

            <button type="submit"
                class="bg-biruPrimary cursor-pointer text-white font-semibold px-4 py-2 rounded hover:bg-opacity-90 transition">
                Kirim Pesan
            </button>
        </form>
    </div>
</x-app-layout>
