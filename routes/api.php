<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;


// Endpoints para Categorías
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);           // Obtener todas las categorías
    Route::post('/', [CategoryController::class, 'store']);          // Crear nueva categoría
    Route::get('/{id}', [CategoryController::class, 'show']);        // Obtener una categoría específica
    Route::put('/{id}', [CategoryController::class, 'update']);      // Actualizar categoría
    Route::delete('/{id}', [CategoryController::class, 'destroy']);  // Eliminar categoría
    
    // Endpoints adicionales para categorías
    Route::get('/{id}/products', [CategoryController::class, 'products']); // Productos de una categoría
});

// Endpoints para Productos
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);                   // Obtener todos los productos
    Route::post('/', [ProductController::class, 'store']);                  // Crear nuevo producto
    Route::get('/{id}', [ProductController::class, 'show']);                // Obtener un producto específico
    Route::put('/{id}', [ProductController::class, 'update']);              // Actualizar producto
    Route::delete('/{id}', [ProductController::class, 'destroy']);          // Eliminar producto
    
    // Endpoints adicionales para productos
    Route::get('/search/{term}', [ProductController::class, 'search']);      // Buscar productos
    Route::patch('/{id}/stock', [ProductController::class, 'updateStock']);  // Actualizar solo stock
});