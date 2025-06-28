<x-app-layout title="Request Akun Official">
<div class="max-w-2xl mx-auto py-8">
    <h2 class="text-xl text-center text-biruPrimary font-bold mb-4">Request Akun Official</h2>
    <form action="{{ route('request-official.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="nama_instansi" class="block text-sm font-medium">Nama Instansi</label>
            <input type="text" name="nama_instansi" id="nama_instansi" class="w-full border rounded-lg px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="alasan" class="block text-sm font-medium">Alasan</label>
            <textarea name="alasan" id="alasan" rows="4" class="w-full border rounded px-3 py-2" required></textarea>
        </div>

        <div class="mb-4">
            <label for="dokumen_pendukung" class="block text-sm font-medium">Dokumen Pendukung</label>
            <input type="file" name="dokumen_pendukung" id="dokumen_pendukung" class="w-full border rounded px-3 py-2" accept=".pdf,.jpg,.png" required>
        </div>
        <div class="flex justify-center">
            <button type="submit" class="bg-biruPrimary cursor-pointer text-white px-4 py-2 rounded">Kirim Permintaan</button>
        </div>
    </form>
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
            <h2 class="text-lg font-bold text-red-600 mb-2">Gagal Mengirim Permintaan</h2>

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