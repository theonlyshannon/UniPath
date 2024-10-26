<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Web\App\CourseController;
use App\Http\Controllers\Web\App\ArticleController;
use App\Http\Controllers\Web\App\DashboardController;


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

Route::name('app.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('artikel')->name('article.')->group(function () {
        Route::get('/', [ArticleController::class, 'index'])->name('index');
        Route::get('/detail', [ArticleController::class, 'show'])->name('show');
    });

    Route::prefix('kelas')->name('course.')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::get('/detail', [CourseController::class, 'show'])->name('show');
    });
});

