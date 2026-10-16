<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LopHocController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Xác thực (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Các chức năng cần đăng nhập
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', function () {
        return redirect()->route('lophoc.index');
    });

    // 1. Quản lý lớp học (Admin + Giảng viên)
    Route::resource('lophoc', LopHocController::class);

    // 2. Quản lý sinh viên (Admin + Giảng viên)
    Route::resource('sinhvien', SinhVienController::class);

    // 3. Quản lý tài khoản của bản thân (Admin + Giảng viên)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // 4. Các chức năng TOÀN QUYỀN chỉ dành riêng cho Quản trị viên (Admin)
    Route::middleware('admin')->group(function () {
        // Quản lý người dùng
        Route::resource('user', UserController::class);

        // Quản lý menu hệ thống
        Route::resource('menu', MenuController::class)->except('show');
    });
});