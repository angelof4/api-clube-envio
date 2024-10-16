<?php

use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\QuoteController;
use App\Models\Carrier;
use App\Models\VtexShippingRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('frete/cotacao', [QuoteController::class, 'getQuote']);
    Route::get('frete/usuario/{userId}/cotacoes', [QuoteController::class, 'getQuoteByUserId']);

});

