<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TodoController;
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
        Route::resource('roles', RoleController::class);
        Route::get('roles/{role}/settings', [RoleController::class, 'setting'])->name('roles.setting');
        Route::delete('roles/{role}/settings/{permission}/revoke', [RoleController::class, 'revokePermission'])->name('roles.revoke_permission');
        Route::post('roles/{role}/settings', [RoleController::class, 'givePermission'])->name('roles.give_permission');
        Route::resource('permissions', PermissionController::class);
    });
});
