<?php

namespace App\Http\Controllers;

use App\Models\Confeitaria;
use App\Http\Requests\StoreConfeitariaRequest;
use App\Http\Requests\UpdateConfeitariaRequest;
use App\Services\ViaCepService;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;


class ConfeitariaController extends Controller
{
    public function index()
    {
        $confeitarias = Confeitaria::orderBy('nome')->get();
        return Inertia::render('Confeitarias/Index', [
            'confeitarias' => $confeitarias,
        ]);
    }

    public function create()
    {
        return Inertia::render('Confeitarias/Form', [
            'initialData' => [
                'nome' => '',
                'telefone' => '',
                'cep' => '',
                'rua' => '',
                'numero' => '',
                'bairro' => '',
                'cidade' => '',
                'estado' => '',
            ],
        ]);
    }

    public function store(StoreConfeitariaRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Autopreenchimento do CEP
        if ($viaCep = ViaCepService::consultar($data['cep'])) {
            $data = array_merge($data, [
                'rua'    => $viaCep['logradouro']  ?? $data['rua'],
                'bairro' => $viaCep['bairro']      ?? $data['bairro'],
                'cidade' => $viaCep['localidade']  ?? $data['cidade'],
                'estado' => $viaCep['uf']          ?? $data['estado'],
            ]);
        }

        Confeitaria::create($data);

        return redirect()->route('confeitarias.index')
            ->with('success', 'Confeitaria cadastrada!');
    }

    public function show(Confeitaria $confeitaria)
    {
        $confeitaria->load('produtos'); // carrega a relação de produtos
        return Inertia::render('Confeitarias/Show', [
            'confeitaria' => $confeitaria,
        ]);
    }

    public function edit(Confeitaria $confeitaria)
    {
        return Inertia::render('Confeitarias/Form', [
            'initialData' => $confeitaria->toArray(),
        ]);
    }

    public function update(UpdateConfeitariaRequest $request, Confeitaria $confeitaria): RedirectResponse
    {
        $data = $request->validated();

        if ($viaCep = ViaCepService::consultar($data['cep'])) {
            $data = array_merge($data, [
                'rua'    => $viaCep['logradouro']  ?? $data['rua'],
                'bairro' => $viaCep['bairro']      ?? $data['bairro'],
                'cidade' => $viaCep['localidade']  ?? $data['cidade'],
                'estado' => $viaCep['uf']          ?? $data['estado'],
            ]);
        }

        $confeitaria->update($data);

        return redirect()->route('confeitarias.index')
            ->with('success', 'Confeitaria atualizada!');
    }

    public function destroy(Confeitaria $confeitaria): RedirectResponse
    {
        $confeitaria->delete();
        return redirect()->route('confeitarias.index')
            ->with('success', 'Confeitaria removida!');
    }
}
