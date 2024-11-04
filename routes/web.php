<?php

use App\Http\Controllers\AboutController as ControllersAboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Payment\CartController;
use App\Http\Controllers\Payment\TransactionController;
use App\Http\Controllers\Web\App\CourseController;
use App\Http\Controllers\Web\App\ArticleController;
use App\Http\Controllers\Web\App\AboutController;
use App\Http\Controllers\Web\App\DashboardController;
use App\Http\Controllers\Web\App\CartController as AppCartController;
use App\Http\Controllers\Web\App\TransactionController as AppTransactionController;

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

// routes/web.php

Route::name('app.')->middleware(['update.last.active'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/about-us', [ControllersAboutController::class, 'index'])->name('about');


    Route::prefix('artikel')->name('article.')->group(function () {
        Route::get('/', [ArticleController::class, 'index'])->name('index');
        Route::get('/{slug}', [ArticleController::class, 'show'])->name('show');
        Route::post('/{slug}/komentar', [ArticleController::class, 'comment'])->name('comment.store');
    });

    Route::prefix('kelas')->name('course.')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::get('/{slug}', [CourseController::class, 'show'])->name('show');
        Route::post('/{id}/review', [CourseController::class, 'review'])->name('review.store');
    });

    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{courseId}', [CartController::class, 'add'])->name('add');
        Route::post('/remove/{cartItemId}', [CartController::class, 'remove'])->name('remove');
    });

    Route::prefix('transaction')->name('transaction.')->group(function () {
        Route::get('/checkout', [TransactionController::class, 'checkout'])->name('checkout');
        Route::post('/process-checkout', [TransactionController::class, 'processCheckout'])->name('processCheckout');
        Route::get('/payment/{transactionCode}', [TransactionController::class, 'payment'])->name('payment.page');
        Route::get('/payment/success/{transactionCode}', [TransactionController::class, 'success'])->name('payment.success');
        Route::get('/success', [TransactionController::class, 'success'])->name('success');
        Route::get('/error', [TransactionController::class, 'error'])->name('error');
    });
});



Route::post('/midtrans/notification', [TransactionController::class, 'receiveNotification'])->name('midtrans.notification');

