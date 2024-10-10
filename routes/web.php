<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\LandingController;

Route::get('/sign-in', function () {
    return view('auth.login');
})->name('sign-in');

Route::get('/', [LandingController::class, 'index']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/article', [ArticleController::class, 'index'])->name('article');
});