<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanController;

Route::prefix('emprestimos')->group(function () {
    Route::get('/instituicoes', [LoanController::class, 'instituicoes']);
    Route::get('/convenios', [LoanController::class, 'convenios']);
    Route::post('/simular', [LoanController::class, 'simular']);
});
