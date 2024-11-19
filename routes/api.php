<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('movies/filter/review', [MovieController::class, 'filterByReview'])->name('movies.filter.review')->middleware('auth:sanctum');

Route::get('reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('reviews/{movie}', [ReviewController::class, 'show'])->name('reviews.show')->middleware('auth:sanctum');
Route::post('reviews/{movie}/rating', [ReviewController::class, 'storeRating'])->name('review.store.rating')->middleware('auth:sanctum');
Route::post('reviews/{movie}/description', [ReviewController::class, 'storeDescription'])->name('review.store.description')->middleware('auth:sanctum');
Route::delete('reviews/{movie}', [ReviewController::class, 'destroy'])->name('review.destroy')->middleware('auth:sanctum');

Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth:sanctum');

Route::post('user/create', [UserController::class, 'create'])->name('user.create');
