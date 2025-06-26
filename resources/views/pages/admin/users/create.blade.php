<x-dashboard>
    <div class="bg-white p-6 rounded shadow-md">
        <h2 class="text-xl font-semibold mb-4">Tambah User Baru</h2>

        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="username" class="block">Username</label>
                <input type="text" name="username" id="username" class="w-full border rounded px-3 py-2"
                    value="{{ old('username') }}" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block">Email</label>
                <input type="email" name="email" id="email" class="w-full border rounded px-3 py-2"
                    value="{{ old('email') }}" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block">Password</label>
                <input type="password" name="password" id="password" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label for="status_user" class="block">Status User</label>
                <select name="status_user" id="status_user" class="w-full border rounded px-3 py-2">
                    <option value="umum">Umum</option>
                    <option value="official">Official</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="role" class="block">Role</label>
                <select name="role" id="role" class="w-full border rounded px-3 py-2">
                    @foreach(\Spatie\Permission\Models\Role::all() as $role)
                        <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.users.index') }}"
                    class="mr-2 bg-gray-300 px-4 py-2 rounded">Batal</a>
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</x-dashboard>
