<?php

use App\Http\Controllers\TicketController\AttenteClientController;
use App\Http\Controllers\TicketController\CloturerTicketController;
use App\Http\Controllers\TicketController\InterTermController;
use App\Http\Controllers\TicketController\TicketOuvertController;
use App\Http\Controllers\TicketController\TraiterTicketController;
use App\Http\Controllers\TicketController\TransfertController;
use App\Http\Controllers\UserController\UserCentreDistribController;
use App\Http\Controllers\UserController\UserServiceController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController\AuthController;
use App\Http\Controllers\UserController\PermissionController;
use App\Http\Controllers\UserController\RoleController;
use App\Http\Controllers\UserController\UserController;
use App\Http\Controllers\UserController\RolePermissionController;
use App\Http\Controllers\UserController\ServiceController;
use App\Http\Controllers\UserController\InterventionController;




Route::get('/', [AuthController::class, 'login'])->name('auth.login');
Route::post('/', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('admin.index')->middleware('isAuth');




##AGENT##
Route::prefix('agent')->middleware(['isAuth','isAgent'])->middleware(['isSuperviseur','isChef'])->middleware(['isAdmin'])->group(function () {
    Route::resource('ticketcloturer', CloturerTicketController::class);
    Route::resource('traiterticket', TraiterTicketController::class);
    Route::resource('ticketouvert', TicketOuvertController::class);
    Route::resource('ticketterminer', InterTermController::class);
    Route::resource('attenteclient', AttenteClientController::class);
    Route::get('traiterticket/{id}', [TraiterTicketController::class, 'show'])->name('traiterticket.show');

});


##SUPERVISEUR##
Route::prefix('superviseur')->middleware(['isAuth','isSuperviseur'])->middleware(['isChef', 'isAdmin'])->group(function () {
    Route::resource('transferticket', TransfertController::class);
    Route::put('transferticket/{transferticket}', [TransfertController::class, 'update'])->name('transferticket.updatedTicket');
});



##CHEF##
Route::prefix('chef')->middleware(['isAuth','isChef'])->middleware(['isAdmin'])->group(function () {
    Route::get('/listeusers', [AuthController::class, 'users'])->name('listUser');
    Route::resource('users', UserController::class);
    Route::resource('userservice', UserServiceController::class);
    Route::resource('usercentre', UserCentreDistribController::class);
    Route::put('/users/delete/{user}', [UserController::class, 'updateDeleted'])->name('users.updateDeleted');
    Route::delete('userservice/deleted/{user}',[UserServiceController::class, 'destroy'])->name('userservice.updateDeleted');
    Route::delete('usercentre/deleted/{user}',[UserCentreDistribController::class, 'destroy'])->name('usercentre.updateDeleted');
});




##ADMIN##
Route::prefix('administrateur')->middleware(['isAuth','isAdmin'])->group(function () {
    Route::put('/roles/delete/{role}', [RoleController::class, 'updateDeleted'])->name('roles.updateDeleted');
    Route::put('/permissions/delete/{permission}', [PermissionController::class, 'updateDeleted'])->name('permissions.updateDeleted');
    Route::delete('rolelier/deleted/{role}', [RolePermissionController::class, 'destroy'])->name('rolelier.updateDeleted');
    Route::delete('services/deleted/{service}', [ServiceController::class, 'destroy'])->name('services.updateDeleted');
    Route::resource('services', ServiceController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('rolelier', RolePermissionController::class);

});







