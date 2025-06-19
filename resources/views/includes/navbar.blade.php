<div x-data="{ open: false, scroll: false }" x-init="
        window.addEventListener('scroll', () => {
            scroll = window.scrollY > 5;
            if (scroll) open = false;
        });
    " :class="scroll
        ? 'py-4 bg-white shadow-md fixed top-0 left-0 right-0 z-50'
        : 'py-4 bg-transparent relative'" class="w-full border-b border-b-gray-300" @click.away="open = false">
    <div class="flex items-center justify-between px-4">
        <!-- Logo -->
        <a href="{{ route('home') }}">
            <div class="flex items-center">
                <img class="h-10 w-auto" src="{{ asset('logo/loop-nobg.png') }}" alt="Logo">
                <h1 class="text-2xl text-biruPrimary font-bold font-jomhuria">Bulikakan</h1>
            </div>
        </a>

        <!-- Icon -->
        <div class="flex gap-x-3 items-center">
            <i data-feather="mail" width="28" height="28" class="fill-[#E3E3E3] stroke-white stroke-2"></i>
            <button @click="open = !open" class="text-biruPrimary focus:outline-none relative z-50">
                <i data-feather="menu" width="30" height="30"></i>
            </button>
        </div>
    </div>

    <!-- Floating Dropdown -->
    <!-- Floating Dropdown -->
    <div x-show="open" x-transition
        class="absolute top-full right-4 mt-2 w-48 bg-white rounded shadow-lg border border-gray-200 py-2 space-y-2 text-sm md:text-base font-semibold text-biruPrimary z-40">
        <a href="#" class="block px-4 py-2 hover:bg-gray-100 transition">Tutorial</a>
        <a href="#" class="block px-4 py-2 hover:bg-gray-100 transition">Tentang Kami</a>
        <a href="#" class="block px-4 py-2 hover:bg-gray-100 transition">Contact Kami</a>

        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-100 transition">
                    Logout
                </button>
            </form>
        @endauth
    </div>

</div>