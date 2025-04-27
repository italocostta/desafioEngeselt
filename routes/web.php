<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CepController;
use App\Http\Controllers\ConfeitariaController;
use App\Http\Controllers\ProdutoController;

Route::get('/', fn() => Inertia::render('Welcome'));

// Consulta de CEP
Route::get('/cep/{cep}', [CepController::class, 'show'])
     ->name('cep.show');

// CRUD de Confeitarias
Route::resource('confeitarias', ConfeitariaController::class);

// Rota customizada para criar produto vinculado a uma confeitaria
Route::get('/confeitarias/{confeitaria}/produto/create', [ProdutoController::class, 'create'])
    ->name('produtos.create');

// CRUD de Produtos (exceto create, porque criamos acima manualmente)
Route::resource('produtos', ProdutoController::class)->except(['create']);
