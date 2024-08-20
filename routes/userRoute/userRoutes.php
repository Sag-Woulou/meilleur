<?php

use App\Http\Controllers\UserController\AuthController;
use App\Http\Controllers\UserController\PermissionController;
use App\Http\Controllers\UserController\RoleController;
use App\Http\Controllers\UserController\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('auth.login');
Route::post('/', [AuthController::class, 'authenticate']);
Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);
Route::resource('permissions', PermissionController::class);
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('admin.index');
