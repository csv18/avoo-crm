<?php

use App\Http\Controllers\Api\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('remote-customer')->group(function () {
    Route::post('/create', [CustomerController::class, 'create']);
    Route::post('/update', [CustomerController::class, 'update']);
    Route::get('/retrieve/{customer_id}', [CustomerController::class, 'retrieve']);
    Route::delete('/delete/{customer_id}', [CustomerController::class, 'delete']);
    Route::get('/list', [CustomerController::class, 'list']);
    Route::get('/search', [CustomerController::class, 'search']);
});
