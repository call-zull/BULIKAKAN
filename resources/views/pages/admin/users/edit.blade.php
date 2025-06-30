<x-dashboard>
    <div class="bg-white p-6 rounded shadow-md max-w-xl mx-auto">
        <h2 class="text-xl font-semibold mb-4">Edit User</h2>

        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="username" class="block">Username</label>
                <input type="text" name="username" id="username" class="w-full border rounded px-3 py-2"
                    value="{{ old('username', $user->username) }}" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block">Email</label>
                <input type="email" name="email" id="email" class="w-full border rounded px-3 py-2"
                    value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block">Password (kosongkan jika tidak diubah)</label>
                <input type="password" name="password" id="password" class="w-full border rounded px-3 py-2">
                <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2 mt-2">
            </div>

            <div class="mb-4">
                <label for="status_user" class="block">Status User</label>
                <select name="status_user" id="status_user" class="w-full border rounded px-3 py-2">
                    <option value="umum" @selected($user->status_user == 'umum')>Umum</option>
                    <option value="official" @selected($user->status_user == 'official')>Official</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="role" class="block">Role</label>
                <select name="role" id="role" class="w-full border rounded px-3 py-2">
                    @foreach ($roles as $role)
                        <option value="{{ $role }}" @selected($user->hasRole($role))>{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.users.index') }}"
                    class="mr-2 bg-gray-300 px-4 py-2 rounded">Batal</a>
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>
</x-dashboard>
