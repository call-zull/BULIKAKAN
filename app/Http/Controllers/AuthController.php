<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Auth\Events\PasswordReset;
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

            if ($user->banned) {
                Auth::logout();
                return back()->withErrors([
                    'login' => 'Akun Anda telah ditangguhkan. Hubungi admin melalui menu Contact Kami untuk kelanjutannya',
                ]);
            }

            if ($user->hasRole('admin')) {
                return redirect()->route('admin.home')->with('success', 'Login berhasil sebagai admin.');
            } elseif ($user->hasRole('berwenang')) {
                return redirect()->route('berwenang.home')->with('success', 'Login berhasil sebagai pihak berwenang.');
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

            if ($user->banned) {
                return redirect()->route('login')->withErrors([
                    'login' => 'Akun Anda telah ditangguhkan. Hubungi admin melalui menu Contact Kami untuk kelanjutannya.',
                ]);
            }

            // Login user jika tidak dibanned
            Auth::login($user, true);

            if ($user->hasRole('admin')) {
                return redirect()->route('admin' . 'admin.home')->with('success', 'Login dengan Google berhasil.');
            } elseif ($user->hasRole('berwenang')) {
                return redirect()->route('berwenang.home')->with('success', 'Login dengan Google berhasil.');
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
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Email yang Anda masukkan belum terdaftar di sistem kami.',
        ]);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'Link reset password berhasil dikirim ke email Anda.')
            : back()->withErrors(['email' => 'Gagal mengirim link reset password / Sudah ada link.']);
    }



    // Tampilkan form reset password
    public function showResetForm(Request $request, $token)
    {
        return view('pages.auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
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

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('password.changed')->with('success', 'Password Anda berhasil diubah.')
            : back()->withErrors(['email' => [__($status)]]);
    }
}
