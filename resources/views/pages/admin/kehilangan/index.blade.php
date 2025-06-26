<x-dashboard>
    <div class="px-4 py-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between w-full gap-3 mb-3">
            <div class="flex items-center gap-2">
                <h1 class="text-2xl font-bold text-biruPrimary">Data Kehilangan</h1>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"
                    id="Lost-And-Found--Streamline-Core" class="w-5">
                    <g id="lost-and-found">
                        <path stroke="#4682B4" stroke-linecap="round" stroke-linejoin="round"
                            d="M11.5 4h-9c-1.10457 0 -2 0.89543 -2 2v5.5c0 1.1046 0.89543 2 2 2h9c1.1046 0 2 -0.8954 2 -2V6c0 -1.10457 -0.8954 -2 -2 -2Z"
                            stroke-width="1" />
                        <path stroke="#4682B4" stroke-linecap="round" stroke-linejoin="round"
                            d="M4.5 4v-0.5c0 -0.66304 0.26339 -1.29893 0.73223 -1.76777C5.70107 1.26339 6.33696 1 7 1c0.66304 0 1.29893 0.26339 1.76777 0.73223C9.23661 2.20107 9.5 2.83696 9.5 3.5V4"
                            stroke-width="1" />
                        <path stroke="#4682B4" stroke-linecap="round" stroke-linejoin="round"
                            d="M5.5 7.5c0 -0.29667 0.08797 -0.58668 0.2528 -0.83335 0.16482 -0.24668 0.39909 -0.43894 0.67317 -0.55247 0.27409 -0.11353 0.57569 -0.14324 0.86667 -0.08536 0.29097 0.05788 0.55824 0.20074 0.76802 0.41052 0.20978 0.20978 0.35264 0.47705 0.41052 0.76803 0.05788 0.29097 0.02817 0.59257 -0.08536 0.86666 -0.11353 0.27409 -0.30579 0.50835 -0.55246 0.67318C7.58668 8.91203 7.29667 9 7 9v0.5"
                            stroke-width="1" />
                        <g>
                            <path stroke="#4682B4" stroke-linecap="round" stroke-linejoin="round"
                                d="M7.00195 11.5c-0.13807 0 -0.25 -0.1119 -0.25 -0.25s0.11193 -0.25 0.25 -0.25"
                                stroke-width="1" />
                            <path stroke="#4682B4" stroke-linecap="round" stroke-linejoin="round"
                                d="M7.00195 11.5c0.13807 0 0.25 -0.1119 0.25 -0.25s-0.11193 -0.25 -0.25 -0.25"
                                stroke-width="1" />
                        </g>
                    </g>
                </svg>
            </div>

            <div class="flex gap-2 justify-between md:justify-end">
                <a href="{{ route('admin.kehilangan.export.excel') }}"
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-sm whitespace-nowrap">
                    Export Excel
                </a>
                <a href="{{ route('admin.kehilangan.export.pdf') }}"
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm whitespace-nowrap">
                    Export PDF
                </a>
            </div>
        </div>



        <div class="bg-white shadow rounded-xl p-4">
            <div class="overflow-x-auto">
                {!! $dataTable->table(['class' => 'table table-bordered table-striped w-full whitespace-nowrap']) !!}
            </div>
        </div>
    </div>

    @push('scripts')
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
                const url = '{{ url('admin/kehilangan') }}/' + id + '/status';

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