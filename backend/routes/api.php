<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::prefix('cliente')->group(function () {
    Route::get('/', [ClientController::class, 'index']);
    Route::get('/{uuid}', [ClientController::class, 'findByClient'])->name('find-client');
    Route::post('/', [ClientController::class, 'store'])->name('store-client');
});

Route::prefix('endereco')->group(function () {
    Route::post('/', [ClientController::class, 'storeAddress']);
    Route::get('/{id}', [ClientController::class, 'getAddress']);
});

Route::get('/type-address', [ClientController::class, 'getTypeAddress'])->name('TypeAddress');
