<?php

namespace App\Http\Controllers;

use App\Services\ViaCepService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class CepController extends Controller
{
    public function show(string $cep): JsonResponse
    {
        try {
            $dados = ViaCepService::consultar($cep);
        } catch (\Throwable $e) {
            // loga o erro para depois inspecionar em storage/logs/laravel.log
            Log::error('Erro ao consultar ViaCEP: '.$e->getMessage());
            return response()->json([
                'error' => 'Erro interno ao consultar CEP'
            ], 500);
        }

        if (!$dados) {
            return response()->json([
                'error' => 'CEP não encontrado'
            ], 404);
        }

        return response()->json($dados);
    }
}
