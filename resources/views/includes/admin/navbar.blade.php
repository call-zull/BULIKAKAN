<div class="w-full bg-white shadow-md p-4 flex justify-between items-center md:justify-end sticky top-0">
    <!-- Logo Bulikakan -->
    <div class="hidden md:flex items-center gap-3 md:mr-auto">
        <img class="h-10 w-auto" src="{{ asset('logo/loop-nobg.png') }}" alt="Logo">
        <h1 class="text-2xl text-biruPrimary font-bold font-jomhuria">Bulikakan</h1>
    </div>

    <!-- Sidebar Toggle Button (visible on mobile) -->
    <div class="md:hidden ml-3">
        <button id="sidebarToggle" class="focus:outline-none" @click="sidebarOpen = !sidebarOpen">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- User Dropdown -->
    <div x-cloak class="relative ml-auto">
        <button @click="open = !open" :aria-expanded="open.toString()"
            class="flex items-center space-x-3 focus:outline-none">
            <img class="h-8 w-8 rounded-full"
                src="https://avataaars.io/?avatarStyle=Circle&topType=ShortHairShortFlat&accessoriesType=Blank&hairColor=Blonde&facialHairType=Blank&clotheType=BlazerShirt&eyeType=Happy&eyebrowType=Default&mouthType=Smile&skinColor=Light"
                alt="Avatar" />
            <span class="text-gray-700 font-poppins cursor-pointer font-semibold">{{ Auth::user()->username }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 cursor-pointer" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div x-show="open" @click.outside="open = false" x-transition
            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg">
            @role('admin')
            <a href="{{ route('admin.profile.edit') }}"
                class="block px-4 py-2 text-biruPrimary cursor-pointer">Profile</a>
            @endrole

            @role('berwenang')
            <a href="{{ route('berwenang.profile.edit') }}"
                class="block px-4 py-2 text-biruPrimary cursor-pointer">Profile</a>
            @endrole

            <a href="{{ route('home') }}" class="block px-4 py-2 text-biruPrimary cursor-pointer">User View</a>
            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full cursor-pointer text-left block px-4 py-2 text-biruPrimary">
                    Logout
                </button>
            </form>

        </div>
    </div>
</div>