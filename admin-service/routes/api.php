<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;

Route::prefix('admin')->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::get('/categories', [ProductController::class, 'getCategories']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    Route::get('/product_images/{id}', [ProductController::class, 'getProductImages']);
    Route::put('/products/{id}/model', [ProductController::class, 'updateModelPath']);
    Route::post('/product_images', [ProductController::class, 'storeProductImage']);
    Route::post('/categories', [ProductController::class, 'storeCategory']);
});
