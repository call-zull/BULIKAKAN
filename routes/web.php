<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');
Route::get('/login', function () {
    return view('pages.login');
})->name('login');
Route::get('/register', function () {
    return view('pages.register');
})->name('register');
Route::get('/forgotPassword', function () {
    return view('pages.forgotPassword');
})->name('forgotPassword');
Route::get('/newPassword', function () {
    return view('pages.newPassword');
})->name('newPassword');
Route::get('/passwordChanged', function () {
    return view('pages.passwordChanged');
})->name('passwordChanged');
Route::get('/profile', function () {
    return view('pages.profile');
})->name('profile');
Route::get('/kehilangan', function () {
    return view('pages.kehilangan');
})->name('kehilangan');
Route::get('/penemuan', function () {
    return view('pages.penemuan');
})->name('penemuan');
