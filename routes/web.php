<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// AUTH
Route::get('/register', [AuthController::class, 'registerIndex'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/auth-google-redirect', [AuthController::class, 'google_redirect'])->name('google_redirect');
Route::get('/auth-google-callback', [AuthController::class, 'google_callback'])->name('google_callback');

Route::get('/', function () {
    return view('pages.user.home');
})->name('home');

// Route::middleware('role:user')->group(function () {
//     Route::get('/', function () {return view('pages.user.home');})->name('home');
// });
Route::middleware('role:admin')->group(function () {
    Route::get('/admin', fn() => view('pages.admin.home'))->name('home-admin');
});
Route::middleware('role:berwenang')->group(function () {
    Route::get('/berwenang', fn() => view('pages.berwenang.home'))->name('home-berwenang');
});

Route::get('/forgotPassword', fn() => view('pages.auth.forgotPassword'))->name('forgotPassword');
Route::get('/newPassword', fn() => view('pages.auth.newPassword'))->name('newPassword');
Route::get('/passwordChanged', fn() => view('pages.auth.passwordChanged'))->name('passwordChanged');
Route::get('/profile', fn() => view('pages.user.profile'))->name('profile');
Route::get('/kehilangan', fn() => view('pages.user.kehilangan'))->name('kehilangan');
Route::get('/penemuan', fn() => view('pages.user.penemuan'))->name('penemuan');
