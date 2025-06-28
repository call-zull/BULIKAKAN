<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KehilanganController;
use App\Http\Controllers\PenemuanController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\KehilanganController as AdminKehilanganController;
use App\Http\Controllers\Admin\PenemuanController as AdminPenemuanController;
use App\Http\Controllers\Admin\RequestOfficialController as AdminRequestOfficialController;
use App\Http\Controllers\Admin\TipeBarangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestOfficialController;

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

// Route::middleware('redirect.role')->group(function () {
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/register', [AuthController::class, 'registerIndex'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::get('/forgotPassword', fn() => view('pages.auth.forgotPassword'))->name('forgotPassword');
Route::get('/newPassword', fn() => view('pages.auth.reset-password'))->name('newPassword');
Route::get('/passwordChanged', fn() => view('pages.auth.passwordChanged'))->name('passwordChanged');

Route::get('/kehilangan', [KehilanganController::class, 'index'])->name('kehilangan');
Route::get('/kehilangan-detail/{pengumuman}', [KehilanganController::class, 'show'])->name('kehilangan.show');

Route::get('/penemuan', [PenemuanController::class, 'index'])->name('penemuan');
Route::get('/penemuan-detail/{pengumuman}', [PenemuanController::class, 'show'])->name('penemuan.show');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
// });

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Halaman profil
    // Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

    // Edit profil
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/request-official', [RequestOfficialController::class, 'create'])->name('request-official.create');
    Route::post('/request-official', [RequestOfficialController::class, 'store'])->name('request-official.store');


    // Tipe Barang
    // Route::resource('tipe-barang', TipeBarangController::class);

    // Kehilangan User
    Route::resource('kehilangan', KehilanganController::class)
        ->parameters(['kehilangan' => 'pengumuman'])
        ->except(['index', 'show', 'edit']);
    Route::get('kehilangan/{pengumuman}/edit', [KehilanganController::class, 'edit'])->name('kehilangan.edit');

    // Penemuan User
    Route::resource('penemuan', PenemuanController::class)
        ->parameters(['penemuan' => 'pengumuman'])
        ->except(['index', 'show', 'edit']);
    Route::get('penemuan/{pengumuman}/edit', [PenemuanController::class, 'edit'])->name('penemuan.edit');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('role:admin')->group(function () {
    // Dashboard
    Route::get('/', [AdminHomeController::class, 'index'])->name('admin.home');

    // Jenis Barang 
    Route::get('tipe-barang', [TipeBarangController::class, 'index'])->name('admin.tipe-barang.index');
    Route::delete('tipe-barang/{id}', [TipeBarangController::class, 'destroy'])->name('admin.tipe-barang.destroy');
    Route::get('tipe-barang/create', [TipeBarangController::class, 'create'])->name('admin.tipe-barang.create');
    Route::post('tipe-barang', [TipeBarangController::class, 'store'])->name('admin.tipe-barang.store');
    Route::get('tipe-barang/{id}/edit', [TipeBarangController::class, 'edit'])->name('admin.tipe-barang.edit');
    Route::put('tipe-barang/{id}', [TipeBarangController::class, 'update'])->name('admin.tipe-barang.update');
    Route::get('admin/tipe-barang/export/pdf', [TipeBarangController::class, 'exportPdf'])->name('admin.tipe-barang.export.pdf');
    Route::get('admin/tipe-barang/export-excel', [TipeBarangController::class, 'exportExcel'])->name('admin.tipe-barang.export');

    // Request Official (Admin)
    Route::get('request-official', [AdminRequestOfficialController::class, 'index'])->name('admin.request-official.index');
    Route::patch('request-official/{id}/status', [AdminRequestOfficialController::class, 'updateStatus'])->name('admin.request-official.updateStatus');
    Route::delete('request-official/{id}', [AdminRequestOfficialController::class, 'destroy'])->name('admin.request-official.destroy');



    // Kehilangan
    Route::get('kehilangan', [AdminKehilanganController::class, 'index'])->name('admin.kehilangan.index');
    Route::get('kehilangan/data', [AdminKehilanganController::class, 'data'])->name('admin.kehilangan.data');
    Route::get('kehilangan/{id}/edit', [AdminKehilanganController::class, 'edit'])->name('admin.kehilangan.edit');
    Route::patch('kehilangan/{id}/status', [AdminKehilanganController::class, 'updateStatus'])->name('admin.kehilangan.updateStatus');
    Route::delete('kehilangan/{id}', [AdminKehilanganController::class, 'destroy'])->name('admin.kehilangan.destroy');
    Route::get('admin/kehilangan/export/excel', [AdminKehilanganController::class, 'exportExcel'])->name('admin.kehilangan.export.excel');
    Route::get('admin/kehilangan/export/pdf', [AdminKehilanganController::class, 'exportPDF'])->name('admin.kehilangan.export.pdf');

    // Penemuan
    Route::get('penemuan', [AdminPenemuanController::class, 'index'])->name('admin.penemuan.index');
    Route::get('penemuan/{id}/edit', [AdminPenemuanController::class, 'edit'])->name('admin.penemuan.edit');
    Route::patch('penemuan/{id}/status', [AdminPenemuanController::class, 'updateStatus'])->name('admin.penemuan.updateStatus');
    Route::delete('penemuan/{id}', [AdminPenemuanController::class, 'destroy'])->name('admin.penemuan.destroy');
    Route::get('/admin/penemuan/export/excel', [AdminPenemuanController::class, 'exportExcel'])->name('admin.penemuan.export.excel');
    Route::get('/admin/penemuan/export/pdf', [AdminPenemuanController::class, 'exportPDF'])->name('admin.penemuan.export.pdf');


    // Carousel
    Route::get('carousel', [CarouselController::class, 'index'])->name('admin.carousel.index');
    Route::get('carousel/create', [CarouselController::class, 'create'])->name('admin.carousel.create');
    Route::post('carousel', [CarouselController::class, 'store'])->name('admin.carousel.store');
    Route::get('carousel/{carousel}/edit', [CarouselController::class, 'edit'])->name('admin.carousel.edit');
    Route::put('carousel/{carousel}', [CarouselController::class, 'update'])->name('admin.carousel.update');
    Route::delete('carousel/{carousel}', [CarouselController::class, 'destroy'])->name('admin.carousel.destroy');

    // Users
    Route::get('users', [UsersController::class, 'index'])->name('admin.users.index');
    Route::patch('users/{user}/status', [UsersController::class, 'updateStatus'])->name('admin.users.updateStatus');
    Route::get('users/create', [UsersController::class, 'create'])->name('admin.users.create');
    Route::post('users', [UsersController::class, 'store'])->name('admin.users.store');
});

/*
|--------------------------------------------------------------------------
| Berwenang Routes
|--------------------------------------------------------------------------
*/
Route::prefix('berwenang')->middleware('role:berwenang')->group(function () {
    // Route::get('/', fn() => view('pages.berwenang.home'))->name('home-berwenang');
    Route::get('/', [AdminHomeController::class, 'index'])->name('berwenang.home');


    // Kehilangan (akses tampilan admin)
    Route::get('/kehilangan', [AdminKehilanganController::class, 'index'])->name('berwenang.kehilangan.index');
    Route::get('/kehilangan/data', [AdminKehilanganController::class, 'data'])->name('berwenang.kehilangan.data');
    Route::get('/kehilangan/{id}/edit', [AdminKehilanganController::class, 'edit'])->name('berwenang.kehilangan.edit');
    Route::patch('/kehilangan/{id}/status', [AdminKehilanganController::class, 'updateStatus'])->name('berwenang.kehilangan.updateStatus');
    Route::delete('/kehilangan/{id}', [AdminKehilanganController::class, 'destroy'])->name('berwenang.kehilangan.destroy');
    Route::get('/kehilangan/export/excel', [AdminKehilanganController::class, 'exportExcel'])->name('berwenang.kehilangan.export.excel');
    Route::get('/kehilangan/export/pdf', [AdminKehilanganController::class, 'exportPDF'])->name('berwenang.kehilangan.export.pdf');

    // Penemuan (akses tampilan admin)
    Route::get('/penemuan', [AdminPenemuanController::class, 'index'])->name('berwenang.penemuan.index');
    Route::get('/penemuan/{id}/edit', [AdminPenemuanController::class, 'edit'])->name('berwenang.penemuan.edit');
    Route::patch('/penemuan/{id}/status', [AdminPenemuanController::class, 'updateStatus'])->name('berwenang.penemuan.updateStatus');
    Route::delete('/penemuan/{id}', [AdminPenemuanController::class, 'destroy'])->name('berwenang.penemuan.destroy');
    Route::get('/penemuan/export/excel', [AdminPenemuanController::class, 'exportExcel'])->name('berwenang.penemuan.export.excel');
    Route::get('/penemuan/export/pdf', [AdminPenemuanController::class, 'exportPDF'])->name('berwenang.penemuan.export.pdf');
});


/*
|--------------------------------------------------------------------------
| Google Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/auth-google-redirect', [AuthController::class, 'google_redirect'])->name('google_redirect');
Route::get('/auth-google-callback', [AuthController::class, 'google_callback'])->name('google_callback');

/*
|--------------------------------------------------------------------------
| Other Testing & Static
|--------------------------------------------------------------------------
*/
