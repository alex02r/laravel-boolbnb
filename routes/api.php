<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApartmentController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ViewController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/apartment', [ApartmentController::class, 'index']);
Route::get('/search', [ApartmentController::class, 'search']);
Route::get('/single/apartment/{slug}/{id}', [ApartmentController::class, 'singleApartment']);

Route::post('/message', [MessageController::class, 'store']);
Route::post('/view', [MessageController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
