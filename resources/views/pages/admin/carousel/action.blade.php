<div class="flex gap-x-2">
    <a href="{{ route('admin.carousel.edit', $row->id) }}"
       class="inline-block px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 text-sm">
        Edit
    </a>

    <form action="{{ route('admin.carousel.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="inline-block px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
            Hapus
        </button>
    </form>
</div>
