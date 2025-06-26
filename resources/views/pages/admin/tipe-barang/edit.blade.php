<x-dashboard>
    <div class="px-4 py-6">
        <h1 class="text-2xl font-bold text-biruPrimary mb-4">Edit Tipe Barang</h1>

        <form method="POST" action="{{ route('admin.tipe-barang.update', $tipe->id) }}" class="bg-white shadow rounded-xl p-6">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="nama" class="block font-medium text-sm">Nama Tipe</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $tipe->nama) }}" required
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                @error('nama')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-x-2">
                <a href="{{ route('admin.tipe-barang.index') }}"
                    class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                <button type="submit"
                    class="px-4 py-2 bg-biruPrimary text-white rounded hover:bg-blue-600">Perbarui</button>
            </div>
        </form>
    </div>
</x-dashboard>
