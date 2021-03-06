<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false, 'reset' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function() {
    Route::prefix('admin')->group(function () {
        Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
        Route::resource('todos', TodoController::class);
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::get('roles/{role}/settings', [RoleController::class, 'setting'])->name('roles.setting');
        Route::post('roles/{role}/settings', [RoleController::class, 'givePermission'])->name('roles.give_permission');
        Route::delete('roles/{role}/settings/{permission}/revoke', [RoleController::class, 'revokePermission'])->name('roles.revoke_permission');
        Route::post('roles/{role}/settings/{user}/assign-role', [RoleController::class, 'assisgnRole'])->name('roles.assign_role');
        Route::delete('roles/{role}/settings/{user}/remove-user', [RoleController::class, 'removeUser'])->name('roles.remove_user');
        Route::resource('permissions', PermissionController::class);
    });
});
