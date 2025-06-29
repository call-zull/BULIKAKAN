<x-dashboard>
    @if (session('success'))
    <div class="alert bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

    <div class="px-4 py-6 overflow-x-auto">
        <h1 class="text-2xl font-bold text-biruPrimary mb-4">Request Official</h1>

        {{ $dataTable->table(['class' => 'w-full text-sm'], true) }}
    </div>

    @push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        // CSRF setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Ubah status request official
        $(document).on('change', '.status-select', function () {
            const id = $(this).data('id');
            const newStatus = $(this).val();
            const url = '{{ url('admin/request-official') }}/' + id + '/status';

            $.ajax({
                url: url,
                method: 'PATCH',
                data: { status_request: newStatus },
                success: function (res) {
                    // Tampilkan notifikasi sukses mirip UsersDataTable
                    const alertBox = $('<div class="fixed top-4 right-4 bg-green-500 text-white p-2 rounded shadow">')
                        .text(res.message)
                        .appendTo('body')
                        .delay(2000)
                        .fadeOut(500, function () { $(this).remove(); });
                },
                error: function (xhr) {
                    alert('Gagal mengubah status.');
                }
            });
        });
    </script>
@endpush

</x-dashboard>
