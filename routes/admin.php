<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', [App\Http\Controllers\Web\Admin\DashboardController::class, 'index'])->name('dashboard');

Route::resource('student', App\Http\Controllers\Web\Admin\studentController::class);;
Route::resource('role', App\Http\Controllers\Web\Admin\RoleController::class);
Route::resource('permission', App\Http\Controllers\Web\Admin\PermissionController::class);
Route::resource('article-category', App\Http\Controllers\Web\Admin\ArticleCategoryController::class);

