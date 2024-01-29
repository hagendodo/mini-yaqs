<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuoteCategoryController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\QuoteLikeController;
use App\Http\Controllers\VideoCategoryController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\VideoLikeController;
use App\Models\Visit;
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

Route::middleware('guest')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('client.index');
    Route::get('/home', [HomeController::class, 'home'])->name('client.home');
    Route::get('/quotes', [HomeController::class, 'quotes'])->name('client.quote');
    Route::get('/videos', [HomeController::class, 'videos'])->name('client.video');
    Route::get('/about', [HomeController::class, 'about'])->name('client.about');
    Route::resource('/quote-likes', QuoteLikeController::class);
    Route::resource('/video-likes', VideoLikeController::class);
});

Route::get('/dashboard', function () {
    $visitors = Visit::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->groupBy('date')
        ->get();

    return view('dashboard', compact(['visitors']));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::resource('/accounts', AccountController::class);
    Route::resource('/quote-categories', QuoteCategoryController::class);
    Route::resource('/video-categories', VideoCategoryController::class);
    Route::resource('/quotes', QuoteController::class);
    Route::resource('/videos', VideoController::class);
});

require __DIR__.'/auth.php';
