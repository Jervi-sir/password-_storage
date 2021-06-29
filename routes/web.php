<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\StatisticController;

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
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::prefix('account')->group(function () {
    Route::get('/add', [AccountController::class, 'add'])->name('account.add');
    Route::get('/show', [AccountController::class, 'show'])->name('account.show');
    Route::post('/upload', [AccountController::class, 'upload'])->name('account.upload');
    Route::post('/update', [AccountController::class, 'update'])->name('account.update');
    Route::post('/edit', [AccountController::class, 'edit'])->name('account.edit');
    Route::post('/delete', [AccountController::class, 'destroy'])->name('account.delete');
});


Route::prefix('social')->group(function () {
    Route::get('/add', [SocialController::class, 'add'])->name('social.add');
    Route::post('/upload', [SocialController::class, 'upload'])->name('social.upload');
    Route::get('/all', [SocialController::class, 'all'])->name('social.all');
    Route::post('/delete', [SocialController::class, 'destroy'])->name('social.delete');
    Route::post('/edit', [SocialController::class, 'edit'])->name('social.edit');
    Route::post('/update', [SocialController::class, 'update'])->name('social.update');
});

Route::prefix('statistic')->group(function () {
    Route::get('/all', [StatisticController::class, 'index'])->name('statistic.all');
    Route::post('/upload', [StatisticController::class, 'upload'])->name('social.upload');
});


require __DIR__ . '/auth.php';
