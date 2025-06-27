<x-app-layout title="Edit Profile">
    <div class="max-w-xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-xl font-bold text-biruPrimary mb-6 text-center">Edit Profil</h2>

        @if ($errors->any())
            <div id="error-modal" tabindex="-1" aria-hidden="true"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
                <div class="bg-white rounded-xl p-6 w-96 shadow-lg text-center relative">
                    <!-- Tombol Close -->
                    <button type="button" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600"
                        onclick="document.getElementById('error-modal').classList.add('hidden')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <!-- Konten Modal -->
                    <h2 class="text-lg font-bold text-red-600 mb-3">Terjadi Kesalahan</h2>
                    <ul class="text-left text-sm text-red-500 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                    <!-- Tombol Tutup -->
                    <div class="mt-4">
                        <button onclick="document.getElementById('error-modal').classList.add('hidden')"
                            class="px-4 py-1 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        @endif


        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            {{-- Foto Profil --}}
            <div class="relative w-fit mx-auto mb-4">
                @php
                    $photoUrl = $user->profile_photo
                        ? asset('storage/' . $user->profile_photo)
                        : 'https://avataaars.io/?avatarStyle=Circle&topType=ShortHairShortFlat&accessoriesType=Blank&hairColor=Blonde&facialHairType=Blank&clotheType=BlazerShirt&eyeType=Happy&eyebrowType=Default&mouthType=Smile&skinColor=Light';
                @endphp

                <img id="preview" src="{{ $photoUrl }}" class="w-24 h-24 rounded-full object-cover" />

                {{-- Icon edit --}}
                <label for="profile_photo"
                    class="absolute bottom-0 right-0 bg-biruPrimary p-1.5 rounded-full cursor-pointer hover:bg-blue-300 transition">
                    <i data-feather="edit" class="w-4 h-4 text-white"></i>
                </label>

                <input type="file" id="profile_photo" name="profile_photo" accept="image/*" class="hidden"
                    onchange="previewImage(event)" />
            </div>

            {{-- Username --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700">Username</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-biruPrimary focus:outline-none">
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-biruPrimary focus:outline-none">
            </div>

            {{-- Password --}}
            <div x-data="{ show: false }">
                <label class="block text-sm font-semibold text-gray-700">Password Baru <span
                        class="text-gray-500 text-xs">(opsional)</span></label>
                <div class="relative">
                    <input :type="show ? 'text' : 'password'" name="password"
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-biruPrimary focus:outline-none">
                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 cursor-pointer"
                        @click="show = !show; $nextTick(() => feather.replace())"
                        x-html="show ? feather.icons['eye-off'].toSvg({ width: '16', height: '16' }) : feather.icons['eye'].toSvg({ width: '16', height: '16' })">
                    </span>
                </div>
            </div>

            {{-- Konfirmasi Password --}}
            {{-- <div x-data="{ show: false }">
                <label class="block text-sm font-semibold text-gray-700">Konfirmasi Password</label>
                <div class="relative">
                    <input :type="show ? 'text' : 'password'" name="password_confirmation"
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-biruPrimary focus:outline-none">
                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 cursor-pointer"
                        @click="show = !show; $nextTick(() => feather.replace())"
                        x-html="show ? feather.icons['eye-off'].toSvg({ width: '16', height: '16' }) : feather.icons['eye'].toSvg({ width: '16', height: '16' })">
                    </span>
                </div>
            </div> --}}


            {{-- Tombol --}}
            <div class="flex justify-end">
                <a href="{{ route('profile.index') }}"
                    class="mr-2 px-4 py-2 text-sm text-gray-600 hover:text-gray-800 transition">Batal</a>
                <button type="submit"
                    class="bg-biruPrimary cursor-pointer text-white px-4 py-2 rounded-md font-semibold text-sm transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    {{-- Preview gambar JS --}}
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                document.getElementById('preview').src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const modal = document.getElementById('error-modal');
                if (modal) {
                    modal.classList.remove('hidden');
                }
            });
        </script>
    @endif

</x-app-layout>