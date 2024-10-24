<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Admin\DashboardController;
use App\Http\Controllers\Student\InterestController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\AIController;
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

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.store');

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register.store');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});

// Dashboard mahasiswa dan pemilihan minat
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::get('/student/select-interests', [InterestController::class, 'show'])->name('student.select-interests.show');
    Route::post('/student/select-interests', [InterestController::class, 'store'])->name('student.select-interests.store');

    Route::get('/student/chatbot', [AIController::class, 'showChatbot'])->name('student.chatbot');
    Route::post('/student/chat', [AIController::class, 'chat'])->name('student.chat');
});


