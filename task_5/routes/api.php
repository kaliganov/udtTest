<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
|
| Product management routes with explicit HTTP methods
|
*/

// Get all products
Route::get('/products', [ProductController::class, 'index']);

// Create a new product
Route::post('/products', [ProductController::class, 'store']);

// Update an existing product
Route::put('/products/{id}', [ProductController::class, 'update']);

// Delete a product
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

