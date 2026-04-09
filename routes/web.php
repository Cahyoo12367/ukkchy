<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('pageAuth');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('pageDashboard');
    Route::get('/users', [UsersController::class, 'index'])->name('pageUsers');
    Route::get('/roles', [DashboardController::class, 'index'])->name('pageRoles');
    Route::get('/menus', [DashboardController::class, 'index'])->name('pageMenus');
    Route::get('/sub-menus', [DashboardController::class, 'index'])->name('pageSubMenus');
});
