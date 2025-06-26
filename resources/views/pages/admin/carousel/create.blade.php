<x-dashboard>
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-700">Tambah Carousel</h2>
        <form action="{{ route('admin.carousel.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block font-medium text-gray-700">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" class="input input-bordered w-full" required>
            </div>
            <div>
                <label class="block font-medium text-gray-700">Foto</label>
                <input type="file" name="foto" class="file-input file-input-bordered w-full" required>
            </div>
            <div>
                <label class="block font-medium text-gray-700">Link (opsional)</label>
                <input type="url" name="link" value="{{ old('link') }}" class="input input-bordered w-full">
            </div>
            <div class="flex items-center gap-x-2">
                <input type="checkbox" name="is_published" value="1" id="is_published" class="checkbox">
                <label for="is_published" class="text-gray-700">Publish sekarang</label>
            </div>
            <div>
                <button type="submit" class="btn bg-green-600 text-white hover:bg-green-700">Simpan</button>
            </div>
        </form>
    </div>
</x-dashboard>