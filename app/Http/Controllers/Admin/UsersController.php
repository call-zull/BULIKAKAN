<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\UsersDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.users.index');
    }

     public function updateStatus(Request $request, User $user)
    {
        $validated = $request->validate([
            'status_user' => ['required', 'in:umum,official'],
        ]);

        $user->status_user = $validated['status_user'];
        $user->save();

        return response()->json([
            'message' => 'Status user berhasil diubah.',
            'status_user' => $user->status_user,
        ]);
    }
    public function create()
{
    return view('pages.admin.users.create');
}
    public function store(Request $request)
{
    $validated = $request->validate([
        'username' => 'required|string|max:255|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'status_user' => 'required|in:umum,official',
        'role' => 'required|exists:roles,name',
    ]);

    $user = User::create([
        'username' => $validated['username'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'status_user' => $validated['status_user'],
    ]);

    $user->assignRole($validated['role']);

    return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
}
    public function edit(User $user)
{
    $roles = Role::pluck('name');
    return view('pages.admin.users.edit', compact('user', 'roles'));
}

public function update(Request $request, User $user)
{
    $validated = $request->validate([
        'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        'email' => 'required|email|unique:users,email,' . $user->id,
        'status_user' => 'required|in:umum,official',
        'role' => 'required|exists:roles,name',
        'password' => 'nullable|string|min:6|confirmed',
    ]);

    $user->update([
        'username' => $validated['username'],
        'email' => $validated['email'],
        'status_user' => $validated['status_user'],
        'password' => $validated['password']
            ? Hash::make($validated['password'])
            : $user->password,
    ]);

    $user->syncRoles([$validated['role']]);

    return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
}

public function destroy(User $user)
{
    $user->delete();
    return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
}

}
