<x-dashboard>
    <div class="px-4 py-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between w-full gap-3 mb-4">
            <h1 class="text-2xl font-bold text-biruPrimary">Data Tipe Barang</h1>

            <div class="flex flex-wrap gap-2 justify-between md:justify-end">
                <a href="{{ route('admin.tipe-barang.export.pdf') }}" target="_blank"
                    class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded text-sm whitespace-nowrap">
                    Export PDF
                </a>
                <a href="{{ route('admin.tipe-barang.export') }}"
                    class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded text-sm whitespace-nowrap">
                    Export Excel
                </a>
                <a href="{{ route('admin.tipe-barang.create') }}"
                    class="bg-biruPrimary text-white px-4 py-2 rounded text-sm whitespace-nowrap">
                    + Tambah Tipe
                </a>
            </div>
        </div>

        {{-- <div class="mb-4 text-right">
            <a href="{{ route('admin.tipe-barang.create') }}"
                class="bg-biruPrimary text-white px-4 py-2 rounded hover:bg-blue-600">
                + Tambah Tipe Barang
            </a>
        </div> --}}


        <div class="bg-white shadow rounded-xl p-4">
            <div class="overflow-x-auto">
                {!! $dataTable->table(['class' => 'table table-bordered table-striped w-full whitespace-nowrap']) !!}
            </div>
        </div>
    </div>

    @push('scripts')
        {!! $dataTable->scripts() !!}
    @endpush
</x-dashboard>