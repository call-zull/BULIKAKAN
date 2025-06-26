<x-app-layout title="Edit Profile">
    <div class="max-w-xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-xl font-bold text-biruPrimary mb-6 text-center">Edit Profil</h2>

        {{-- Validasi error --}}
        @if ($errors->any())
            <div class="mb-4 text-red-600 text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Flash message --}}
        @if(session('success'))
            <div class="mb-4 p-3 rounded-md bg-green-100 text-green-800 text-sm">
                {{ session('success') }}
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
                <label for="profile_photo" class="absolute bottom-0 right-0 bg-biruPrimary p-1.5 rounded-full cursor-pointer hover:bg-blue-300 transition">
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
            <div>
                <label class="block text-sm font-semibold text-gray-700">Password Baru <span class="text-gray-500 text-xs">(opsional)</span></label>
                <input type="password" name="password"
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-biruPrimary focus:outline-none">
            </div>

            {{-- Konfirmasi Password --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-biruPrimary focus:outline-none">
            </div>

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
            reader.onload = function(){
                document.getElementById('preview').src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-app-layout>
