@php
    $isActive = fn($route) => Route::is($route);
@endphp

<div class="fixed bottom-0 left-0 right-0 z-50 border-t border-t-gray-300 bg-white shadow-md">
    <div class="flex justify-around items-center h-16">
        <!-- Home -->
        <a href="{{ route('home') }}" class="flex flex-col items-center text-biruPrimary">
            <i data-feather="home" class="{{ $isActive('home') ? 'text-biruPrimary' : '' }}"></i>
            <span class="text-xs font-semibold mt-1 px-2 py-0.5 rounded-xl transition-all duration-200 {{ $isActive('home') ? 'bg-biruPrimary text-white' : '' }}">
                Home
            </span>
        </a>

        <!-- Kehilangan -->
        <a href="{{ route('kehilangan') }}" class="flex flex-col items-center text-biruPrimary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"
                id="Lost-And-Found--Streamline-Core" class="w-5">
                <g id="lost-and-found">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        d="M11.5 4h-9c-1.10457 0 -2 0.89543 -2 2v5.5c0 1.1046 0.89543 2 2 2h9c1.1046 0 2 -0.8954 2 -2V6c0 -1.10457 -0.8954 -2 -2 -2Z"
                        stroke-width="1" />
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        d="M4.5 4v-0.5c0 -0.66304 0.26339 -1.29893 0.73223 -1.76777C5.70107 1.26339 6.33696 1 7 1c0.66304 0 1.29893 0.26339 1.76777 0.73223C9.23661 2.20107 9.5 2.83696 9.5 3.5V4"
                        stroke-width="1" />
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        d="M5.5 7.5c0 -0.29667 0.08797 -0.58668 0.2528 -0.83335 0.16482 -0.24668 0.39909 -0.43894 0.67317 -0.55247 0.27409 -0.11353 0.57569 -0.14324 0.86667 -0.08536 0.29097 0.05788 0.55824 0.20074 0.76802 0.41052 0.20978 0.20978 0.35264 0.47705 0.41052 0.76803 0.05788 0.29097 0.02817 0.59257 -0.08536 0.86666 -0.11353 0.27409 -0.30579 0.50835 -0.55246 0.67318C7.58668 8.91203 7.29667 9 7 9v0.5"
                        stroke-width="1" />
                    <g>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            d="M7.00195 11.5c-0.13807 0 -0.25 -0.1119 -0.25 -0.25s0.11193 -0.25 0.25 -0.25"
                            stroke-width="1" />
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            d="M7.00195 11.5c0.13807 0 0.25 -0.1119 0.25 -0.25s-0.11193 -0.25 -0.25 -0.25"
                            stroke-width="1" />
                    </g>
                </g>
            </svg>
            <span class="text-xs font-semibold mt-1 px-2 py-0.5 rounded-xl transition-all duration-200 {{ $isActive('kehilangan') ? 'bg-biruPrimary text-white' : '' }}">
                Kehilangan
            </span>
        </a>

        <!-- Tombol Tengah -->
        <a href="#"
            class="flex flex-col items-center text-white bg-biruPrimary p-3 rounded-full -mt-6 shadow-lg">
            <i data-feather="plus"></i>
        </a>

        <!-- Penemuan -->
        <a href="{{ route('penemuan') }}" class="flex flex-col items-center text-biruPrimary">
            <img src="{{ asset('logo/icon-find.png') }}" class="w-5" alt="icon-kehilangan">
            <span class="text-xs font-semibold mt-1 px-2 py-0.5 rounded-xl transition-all duration-200 {{ $isActive('penemuan') ? 'bg-biruPrimary text-white' : '' }}">
                Penemuan
            </span>
        </a>

        <!-- Profile -->
        <a href="{{ route('profile') }}" class="flex flex-col items-center text-biruPrimary">
            <i data-feather="user"></i>
            <span class="text-xs font-semibold mt-1 px-2 py-0.5 rounded-xl transition-all duration-200 {{ $isActive('profile') ? 'bg-biruPrimary text-white' : '' }}">
                Profile
            </span>
        </a>
    </div>
</div>
