<x-dashboard>
    <div class="px-4 py-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between w-full gap-3 mb-3">
            <div class="flex items-center gap-2">
                <h1 class="text-2xl font-bold text-biruPrimary">Data Penemuan</h1>
                <img src="{{ asset('logo/icon-find.png') }}" class="w-5" alt="icon-penemuan">
            </div>

            <div class="flex gap-2 justify-between md:justify-end">
                <a href="{{ route('admin.penemuan.export.excel') }}"
                    class="bg-green-500 text-white px-3 py-1 rounded text-sm hover:bg-green-600 whitespace-nowrap">
                    Export Excel
                </a>
                <a href="{{ route('admin.penemuan.export.pdf') }}"
                    class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600 whitespace-nowrap">
                    Export PDF
                </a>
            </div>
        </div>


        <div class="bg-white shadow rounded-xl p-4">
            <div class="overflow-x-auto"> {{-- hanya tabel yang scroll --}}
                {!! $dataTable->table(['class' => 'table table-bordered table-striped w-full whitespace-nowrap'], true) !!}
            </div>
        </div>
    </div>

    @push('scripts')
        @vite(['resources/js/app.js']) {{-- kalau pakai Vite --}}
        {!! $dataTable->scripts() !!}

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('change', '.status-select', function () {
                const id = $(this).data('id');
                const status = $(this).val();
                const url = '{{ url('admin/penemuan') }}/' + id + '/status';

                $.ajax({
                    url: url,
                    method: 'PATCH',
                    data: { status },
                    success: function (res) {
                        const alertBox = $('<div class="fixed top-4 right-4 bg-green-500 text-white p-2 rounded shadow z-50">')
                            .text(res.message)
                            .appendTo('body')
                            .delay(2000)
                            .fadeOut(500, function () { $(this).remove(); });
                    },
                    error: function () {
                        alert('Gagal memperbarui status.');
                    }
                });
            });
        </script>
    @endpush

</x-dashboard>