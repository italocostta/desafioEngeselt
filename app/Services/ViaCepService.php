<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ViaCepService
{
    public static function consultar(string $cep): ?array
    {
        $cleanCep = preg_replace('/\D/', '', $cep);
    
        // Desabilita verificação de certificado (apenas em dev)
        $response = Http::withOptions([
            'verify' => false,
        ])->get("https://viacep.com.br/ws/{$cleanCep}/json/");
    
        if ($response->ok() && empty($response->json('erro'))) {
            return $response->json();
        }
    
        return null;
    }
    
}
