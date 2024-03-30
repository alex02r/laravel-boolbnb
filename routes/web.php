<?php

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ApartmentController;
use App\Http\Controllers\User\SponsorController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth','verified'])
    ->name('user.')
    ->prefix('user')
    ->group(function(){
        // ROTTA PER LA DASHBOARD IN CUI ATTERRA L'UTENTE DOPO AVER EFF. LOGIN
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/apartment', ApartmentController::class);
        Route::resource('/sponsor', SponsorController::class);
        Route::get('/payments/{apartment}/{sponsor}', [SponsorController::class, 'payment'])->name('payment');
});

// ROTTA FALLBACK PER IL NOT FOUND
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

// ROTTA PER LA PAGINA NOT AUTHORIZED
Route::get('*/not-authorized', function () {
    return view('not_authorized');
})->name('not.authorized');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';