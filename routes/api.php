<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\FoodController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Auth\GoogleAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

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

Route::post('/comments', [CommentController::class, 'store'])->middleware('auth:sanctum');


Route::get('/sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::put('/update', [AuthController::class, 'update'])->middleware('auth:sanctum');
Route::put('/update-photo', [AuthController::class, 'updatePhoto'])->middleware('auth:sanctum');

Route::get('/foods', [FoodController::class, 'index']);
Route::get('/foods/{id}', [FoodController::class, 'show']);

Route::post('/orders', [OrderController::class, 'store'])->middleware('auth:sanctum');
Route::get('/orders', [OrderController::class, 'index'])->middleware('auth:sanctum');
Route::post('/ratings', [RatingController::class, 'store'])->middleware('auth:sanctum');

Route::get('/history/orders', [OrderController::class, 'getOrders'])->middleware('auth:sanctum');
Route::get('/history/orders/analytics', [OrderController::class, 'getAnalytics'])->middleware('auth:sanctum');
Route::get('/history/orders/reports', [OrderController::class, 'export'])->middleware('auth:sanctum');

Route::post('/auth/google', [GoogleAuthController::class, 'authenticate'])->middleware('crp');

