<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProjectController;
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
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

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
    Route::get('/edit', [SocialController::class, 'edit'])->name('social.edit');
    Route::post('/update', [SocialController::class, 'update'])->name('social.update');
});

Route::prefix('project')->group(function () {
    Route::get('/add', [ProjectController::class, 'add'])->name('project.add');
    Route::post('/upload', [ProjectController::class, 'upload'])->name('project.upload');
    Route::get('/all', [ProjectController::class, 'all'])->name('project.all');
    Route::post('/edit', [ProjectController::class, 'edit'])->name('project.edit');
    Route::post('/update', [ProjectController::class, 'update'])->name('project.update');

    Route::prefix('account')->group(function () {
        Route::get('/edit', [ProjectController::class, 'accountEdit'])->name('projectAccount.edit');
        Route::get('/add', [ProjectController::class, 'accountAdd'])->name('projectAccount.add');
        Route::post('/upload', [ProjectController::class, 'accountUpload'])->name('projectAccount.upload');
        Route::post('/update', [ProjectController::class, 'accountUpdate'])->name('projectAccount.update');
        Route::post('/delete', [ProjectController::class, 'accountDestroy'])->name('projectAccount.delete');

    });
});

Route::prefix('statistic')->group(function () {
    Route::get('/all', [StatisticController::class, 'index'])->name('statistic.all');
});


require __DIR__.'/auth.php';
