<?php

use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\QuoteController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);


/**
 * Estas rotas estão agrupadas pelo middleware  sanctum, então será
 * necessário autenticaçao para poder acessa-las
 */
Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });


    Route::get('frete/cotacao', [QuoteController::class, 'getQuote']);
    Route::get('frete/cotacao/{quoteId}', [QuoteController::class, 'getQuoteById']);
    Route::get('frete/usuario/{userId}/cotacoes', [QuoteController::class, 'getQuoteByUserId']);
});

