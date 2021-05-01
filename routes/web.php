<?php

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
    });
});
