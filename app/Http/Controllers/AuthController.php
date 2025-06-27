<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Mail;

use Str;

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
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $login_type = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $login_type => $request->login,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, true)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->hasRole('admin')) {
                return redirect()->route('admin.home')->with('success', 'Login berhasil sebagai admin.');
            } elseif ($user->hasRole('berwenang')) {
                return redirect()->route('home-berwenang')->with('success', 'Login berhasil sebagai pihak berwenang.');
            } else {
                return redirect()->route('home')->with('success', 'Login berhasil.');
            }
        }

        return back()->withErrors([
            'login' => 'Email/Username atau password salah.',
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
                return redirect()->route('admin' . 'admin.home')->with('success', 'Login dengan Google berhasil.');
            } elseif ($user->hasRole('berwenang')) {
                return redirect()->route('home-berwenang')->with('success', 'Login dengan Google berhasil.');
            } else {
                return redirect()->route('home')->with('success', 'Login dengan Google berhasil.');
                // flash()
                //     ->option('position', 'top-center')
                //     ->option('timeout', 5000)
                //     ->success('Login dengan Google berhasil.');

                // return redirect()->route('home');
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

    public function showForgotPasswordForm()
    {
        return view('pages.auth.forgotPassword');
    }

    // Kirim link reset password
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan.');
        }

        // Generate token
        $token = Str::random(60);
        $user->reset_token = $token;
        $user->save();

        // Link reset
        $resetLink = url("/reset-password/$token?email=" . urlencode($request->email));

        // Kirim email
        Mail::send([], [], function ($message) use ($user, $resetLink) {
            $message->to($user->email)
                ->subject('Reset Password - SI NOTARIS')
                ->html(
                    '<h2>Halo ' . $user->name . ',</h2>' .
                        '<p>Kami menerima permintaan reset password.</p>' .
                        '<p><a href="' . $resetLink . '" style="background-color: #1d4ed8; padding: 10px 15px; color: white; text-decoration: none; border-radius: 5px;">Reset Password</a></p>' .
                        '<p>Jika Anda tidak meminta ini, abaikan saja.</p>'
                );
        });

        return back()->with('success', 'Link reset password telah dikirim ke email Anda.');
    }

    // Tampilkan form reset password
    public function showResetForm(Request $request, $token)
    {
        $user = User::where('email', $request->email)
            ->where('reset_token', $token)
            ->first();

        if (!$user) {
            return redirect()->route('password.request')->with('error', 'Token tidak valid atau telah digunakan.');
        }

        return view('pages.auth.reset-password', [
            'token' => $token,
            'email' => $user->email,
        ]);
    }


    // Proses simpan password baru
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::where('email', $request->email)
            ->where('reset_token', $request->token)
            ->first();

        if (!$user) {
            return redirect()->route('password.request')->with('error', 'Token tidak valid.');
        }

        $user->password = bcrypt($request->password);
        $user->reset_token = null;
        $user->save();

        return redirect()->route('login')->with('success', 'Password berhasil direset.');
    }
}
