<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CepController extends Controller
{
    /**
     * Busca informações de endereço a partir de um CEP informado.
     *
     * @param  string  $cep
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($cep)
{
    $cep = preg_replace('/[^0-9]/', '', $cep);

    if (strlen($cep) !== 8) {
        return response()->json(['erro' => 'CEP inválido'], 400);
    }

    try {
        $response = file_get_contents("https://viacep.com.br/ws/{$cep}/json/");
        $data = json_decode($response, true);

        if (isset($data['erro']) && $data['erro']) {
            return response()->json(['erro' => 'CEP não encontrado'], 404);
        }

        return response()->json([
            'rua'    => $data['logradouro'] ?? '',
            'bairro' => $data['bairro'] ?? '',
            'cidade' => $data['localidade'] ?? '',
            'estado' => $data['uf'] ?? '',
        ]);
    } catch (\Exception $e) {
        return response()->json(['erro' => 'Erro ao consultar o CEP'], 500);
    }
}

}
