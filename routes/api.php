<?php

use App\Models\Item;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ItemController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\TransactionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/article', [ArticleController::class, 'index']);
// Route::post('/article', [ArticleController::class, 'store']);
// Route::get('/article/{id}', [ArticleController::class, 'show']);
// Route::put('/article/{id}', [ArticleController::class, 'update']);
// Route::delete('/article/{id}', [ArticleController::class, 'destroy']);
// });

Route::apiResource('/article', ArticleController::class);

Route::get('/article-data', [ArticleController::class, 'dataTable'])->name('article.dataTable');
Route::get('/dashboard-data', [DashboardController::class, 'getDashboardData']);