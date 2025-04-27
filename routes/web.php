<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CepController;
use App\Http\Controllers\ConfeitariaController;

Route::get('/', fn() => Inertia::render('Welcome'));


Route::get('/cep/{cep}', [CepController::class, 'show'])
     ->name('cep.show');


Route::resource('confeitarias', ConfeitariaController::class);
