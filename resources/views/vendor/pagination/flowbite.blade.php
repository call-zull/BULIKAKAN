@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="flex items-center -space-x-px h-10 text-base">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-400 bg-white border border-e-0 border-gray-300 rounded-s-lg">
                        <span class="sr-only">Previous</span>
                        <svg class="w-3 h-3 rtl:rotate-180" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" d="M5 1 1 5l4 4"/>
                        </svg>
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                       class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                        <span class="sr-only">Previous</span>
                        <svg class="w-3 h-3 rtl:rotate-180" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" d="M5 1 1 5l4 4"/>
                        </svg>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li>
                        <span class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span class="z-10 flex items-center justify-center px-4 h-10 leading-tight text-biruPrimary border border-blue-300 bg-blue-50">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                   class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                       class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                        <span class="sr-only">Next</span>
                        <svg class="w-3 h-3 rtl:rotate-180" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" d="m1 9 4-4-4-4"/>
                        </svg>
                    </a>
                </li>
            @else
                <li>
                    <span class="flex items-center justify-center px-4 h-10 leading-tight text-gray-400 bg-white border border-gray-300 rounded-e-lg">
                        <span class="sr-only">Next</span>
                        <svg class="w-3 h-3 rtl:rotate-180" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" d="m1 9 4-4-4-4"/>
                        </svg>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
