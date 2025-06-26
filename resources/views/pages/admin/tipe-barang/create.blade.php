<x-dashboard>
    <div class="px-4 py-6">
        <h1 class="text-2xl font-bold text-biruPrimary mb-4">Tambah Tipe Barang</h1>

        <form method="POST" action="{{ route('admin.tipe-barang.store') }}" class="bg-white shadow rounded-xl p-6">
            @csrf
            <div class="mb-4">
                <label for="nama" class="block font-semibold text-lg text-black mb-2">Nama Tipe</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                    class="mt-1 block w-full h-10 rounded border-gray-300 shadow-sm">
                @error('nama')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-x-2">
                <a href="{{ route('admin.tipe-barang.index') }}"
                    class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                <button type="submit"
                    class="px-4 py-2 bg-biruPrimary text-white rounded hover:bg-blue-600">Simpan</button>
            </div>
        </form>
    </div>
</x-dashboard>
