<x-dashboard>
    @if (session('success'))
        <div class="alert bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-700">Data Pengguna</h2>
            <a href="{{ route('admin.users.create') }}" class="btn text-white bg-biruPrimary p-2 rounded-2xl">
                <i class="fa fa-plus mr-1"></i> Tambah User
            </a>

        </div>
        <div class="overflow-x-auto">
            {{ $dataTable->table(['class' => 'w-full text-sm text-left']) }}
        </div>
    </div>

    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

        <script>
            // Setup CSRF untuk AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('change', '.banned-dropdown', function () {
                console.log('Dropdown changed');

                const userId = $(this).data('id');
                const bannedStatus = $(this).val();
                console.log({ userId, bannedStatus });

                $.ajax({
                    url: '{{ route("admin.users.banned", ":id") }}'.replace(':id', userId),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        banned: bannedStatus
                    },
                    success: function (res) {
                        console.log('Success:', res);
                        $('#datatable').DataTable().ajax.reload();
                        const alertBox = $('<div class="fixed top-4 right-4 bg-green-500 text-white p-2 rounded shadow">')
                            .text(res.message ?? 'Status banned berhasil diperbarui.')
                            .appendTo('body')
                            .delay(2000)
                            .fadeOut(500, function () { $(this).remove(); });
                    },
                    error: function (xhr) {
                        console.log('Error:', xhr.responseText);
                        alert('Terjadi kesalahan.');
                    }
                });
            });

            // Ketika dropdown status diubah
            $(document).on('change', '.status-select', function () {
                const userId = $(this).data('id');
                const newStatus = $(this).val();
                const url = '{{ url('admin/users') }}/' + userId + '/status';

                $.ajax({
                    url: url,
                    method: 'PATCH',
                    data: { status_user: newStatus },
                    success: function (res) {
                        // Tampilkan notifikasi singkat
                        const alertBox = $('<div class="fixed top-4 right-4 bg-green-500 text-white p-2 rounded shadow">')
                            .text(res.message)
                            .appendTo('body')
                            .delay(2000)
                            .fadeOut(500, () => $(this).remove());
                    },
                    error: function (xhr) {
                        alert('Gagal mengubah status. Silakan coba lagi.');
                    }
                });
            });
        </script>
    @endpush
</x-dashboard>