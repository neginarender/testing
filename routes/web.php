<?php

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


Auth::routes(['verify'=>true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => '','middleware' => ['auth','verified', 'permission'] , 'namespace' => 'App\Http\Controllers'], function() {
    Route::resource('users', UserController::class);
    Route::resource('roles', RolesController::class);
    Route::resource('permissions', PermissionController::class);
});
Route::group(['prefix' => '','middleware' => ['auth','verified'] , 'namespace' => 'App\Http\Controllers'], function() {
    Route::resource('profiles', ProfileController::class);
});