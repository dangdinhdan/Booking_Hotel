<?php

use App\Http\Controllers\LopHocController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SinhVienController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('lophoc.index');
});

Route::resource('lophoc', LopHocController::class);

Route::resource('menu', MenuController::class)->except('show');

Route::resource('sinhvien', SinhVienController::class);