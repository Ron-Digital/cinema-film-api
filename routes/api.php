<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(ActorController::class)->prefix('actors')->group(function() {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{actor}', 'show');
    Route::put('/{actor}', 'update');
    Route::delete('/{actor}', 'destroy');
});

Route::controller(CategoryController::class)->prefix('categories')->group(function() {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{category}', 'show');
    Route::put('/{category}', 'update');
    Route::delete('/{category}', 'destroy');
});

Route::controller(CenterHallController::class)->prefix('center_halls')->group(function() {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{center_hall}', 'show');
    Route::put('/{center_hall}', 'update');
    Route::delete('/{center_hall}', 'destroy');
});

Route::controller(DirectorController::class)->prefix('directors')->group(function() {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{director}', 'show');
    Route::put('/{director}', 'update');
    Route::delete('/{director}', 'destroy');
});

Route::controller(HallSeatController::class)->prefix('hall-seats')->group(function() {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{hall-seat}', 'show');
    Route::put('/{hall-seat}', 'update');
    Route::delete('/{hall-seat}', 'destroy');
});

Route::controller(HallSessionController::class)->prefix('hall-sessions')->group(function() {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{hall-session}', 'show');
    Route::put('/{hall-session}', 'update');
    Route::delete('/{hall-session}', 'destroy');
});

Route::controller(MovieCenterController::class)->prefix('movie-centers')->group(function() {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{movie-center}', 'show');
    Route::put('/{movie-center}', 'update');
    Route::delete('/{movie-center}', 'destroy');
});

Route::controller(MovieController::class)->prefix('movies')->group(function() {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{movie}', 'show');
    Route::put('/{movie}', 'update');
    Route::delete('/{movie}', 'destroy');
});

Route::controller(PaymentController::class)->prefix('payments')->group(function() {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{payment}', 'show');
    Route::put('/{payment}', 'update');
    Route::delete('/{payment}', 'destroy');
});

Route::controller(PaymentPlanController::class)->prefix('payment-plans')->group(function() {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{payment-plan}', 'show');
    Route::put('/{payment-plan}', 'update');
    Route::delete('/{payment-plan}', 'destroy');
});

Route::controller(TicketController::class)->prefix('tickets')->group(function() {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{ticket}', 'show');
    Route::put('/{ticket}', 'update');
    Route::delete('/{ticket}', 'destroy');
});

Route::controller(UserController::class)->prefix('users')->group(function() {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{user}', 'show');
    Route::put('/{user}', 'update');
    Route::delete('/{user}', 'destroy');
});
