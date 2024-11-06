<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Admin\RoleController;
use App\Http\Controllers\Web\Admin\CourseController;
use App\Http\Controllers\Web\Admin\MentorController;
use App\Http\Controllers\Web\Admin\WriterController;
use App\Http\Controllers\Web\Admin\ArticleController;
use App\Http\Controllers\Web\Admin\FacultyController;
use App\Http\Controllers\Web\Admin\studentController;
use App\Http\Controllers\Web\Admin\ArticleTagController;
use App\Http\Controllers\Web\Admin\PermissionController;
use App\Http\Controllers\Web\Admin\UniversityController;
use App\Http\Controllers\Web\Admin\TransactionController;
use App\Http\Controllers\Web\Admin\CourseReviewController;
use App\Http\Controllers\Web\Admin\ArticleCommentController;
use App\Http\Controllers\Web\Admin\CourseCategoryController;
use App\Http\Controllers\Web\Admin\ArticleCategoryController;

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

Route::resource('mentor', MentorController::class);
Route::resource('student', studentController::class);
Route::resource('writer', WriterController::class);
Route::resource('role', RoleController::class);
Route::resource('permission', PermissionController::class);

Route::resource('article-category', ArticleCategoryController::class);
Route::resource('article-commentar', ArticleCommentController::class);
Route::resource('article-tag', ArticleTagController::class);
Route::resource('article', ArticleController::class);

Route::resource('university', UniversityController::class);
Route::resource('faculty', FacultyController::class);
Route::post('faculty/scrape', [FacultyController::class, 'scrape'])->name('faculty.scrape');

Route::resource('course-category', CourseCategoryController::class);
Route::resource('course', CourseController::class);
Route::resource('course-review', CourseReviewController::class);
Route::post('/course-review/{courseReviewId}/update-status', [CourseReviewController::class, 'updateStatusIsActive']);
Route::post('/course/{courseId}/update-status', [CourseController::class, 'updateStatusIsActive']);
Route::post('/course/{courseId}/update-favourite', [CourseController::class, 'updateStatusIsFavourite']);

Route::resource('transaction', TransactionController::class);
Route::post('transaction/{id}/update-status', [TransactionController::class, 'updateStatus'])->name('transaction.update-status');
