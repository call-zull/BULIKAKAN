<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function registerIndex()
    {
        return view('pages.auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'username' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status_user' => 'umum',
        ]);

        $user->assignRole('user');

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

    public function loginForm()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), true)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->hasRole('admin')) {
                return redirect()->route('home-admin');
            } elseif ($user->hasRole('berwenang')) {
                return redirect()->route('home-berwenang');
            } else {
                return redirect()->route('home');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    public function google_redirect()
    {
        return Socialite::driver('google')
            ->with(config('services.google.additional_params'))
            ->redirect();
    }
    public function google_callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Coba cari berdasarkan provider_id (yang paling aman)
            $user = User::where('provider', 'google')
                ->where('provider_id', $googleUser->getId())
                ->first();

            if (!$user) {
                // Jika belum ada berdasarkan provider_id, cari berdasarkan email
                $user = User::where('email', $googleUser->getEmail())->first();

                if (!$user) {
                    // Jika user juga belum ada berdasarkan email, buat user baru
                    $user = User::create([
                        'username' => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                        'password' => Hash::make(uniqid()),
                        'status_user' => 'umum',
                        'email_verified_at' => now(),
                        'provider' => 'google',
                        'provider_id' => $googleUser->getId(),
                    ]);
                } else {
                    // Jika sudah ada user berdasarkan email, update provider info
                    $user->update([
                        'provider' => 'google',
                        'provider_id' => $googleUser->getId(),
                    ]);
                }
            }

            // ✅ Pastikan user punya role minimal 'user'
            if (!$user->hasAnyRole(['user', 'admin', 'berwenang'])) {
                $user->assignRole('user');
            }

            // Login user
            Auth::login($user, true);

            if ($user->hasRole('admin')) {
                return redirect()->route('home-admin')->with('success', 'Login dengan Google berhasil.');
            } elseif ($user->hasRole('berwenang')) {
                return redirect()->route('home-berwenang')->with('success', 'Login dengan Google berhasil.');
            } else {
                return redirect()->route('home')->with('success', 'Login dengan Google berhasil.');
            }
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Terjadi kesalahan saat login Google.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}
