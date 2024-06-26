<?php

use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/pens', [PenController::class, 'index']);
Route::post('/pens', [PenController::class, 'store']);
Route::get('/pens/{pen:id}', [PenController::class, 'edit']);
Route::patch('/pens/{pen:id}', [PenController::class, 'update']);
Route::delete('/pens/{pen:id}', [PenController::class, 'delete']);

Route::get('/orders', [OrderController::class, 'index']);
Route::post('/orders', [OrderController::class, 'store']);
Route::get('/orders/create', [OrderController::class, 'create']);
Route::get('/orders/{order:id}', [OrderController::class, 'edit']);
Route::patch('/orders/{order:id}', [OrderController::class, 'update']);
Route::delete('/orders/{order:id}', [OrderController::class, 'delete']);
Route::put('/orders/{order:id}', [OrderController::class, 'ship']);