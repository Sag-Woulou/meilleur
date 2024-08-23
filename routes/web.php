<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController\AuthController;
use App\Http\Controllers\UserController\PermissionController;
use App\Http\Controllers\UserController\RoleController;
use App\Http\Controllers\UserController\UserController;
use App\Http\Controllers\UserController\RolePermissionController;





Route::get('/', [AuthController::class, 'login'])->name('auth.login');
Route::post('/', [AuthController::class, 'authenticate']);
Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);
Route::resource('permissions', PermissionController::class);
Route::resource('rolelier', RolePermissionController::class);
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('admin.index');
Route::put('/users/delete/{user}', [UserController::class, 'updateDeleted'])->name('users.updateDeleted');
Route::put('/roles/delete/{role}', [RoleController::class, 'updateDeleted'])->name('roles.updateDeleted');
Route::put('/permissions/delete/{permission}', [PermissionController::class, 'updateDeleted'])->name('permissions.updateDeleted');
Route::delete('rolelier/deleted/{rolePermission}', [RolePermissionController::class, 'destroy'])->name('rolelier.updateDeleted');

