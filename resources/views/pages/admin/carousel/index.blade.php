<x-dashboard>
    @if(session('success'))
        <div class="alert bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-700">Data Carousel</h2>
            <a href="{{ route('admin.carousel.create') }}" class="btn bg-biruPrimary p-2 rounded-2xl text-white">
                <i class="fa fa-plus mr-1"></i>Carousel
            </a>
        </div>

        {{ $dataTable->table(['class' => 'w-full text-sm text-left']) }}
    </div>

    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
</x-dashboard>