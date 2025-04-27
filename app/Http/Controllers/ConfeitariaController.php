<?php

namespace App\Http\Controllers;

use App\Models\Confeitaria;
use App\Http\Requests\StoreConfeitariaRequest;
use App\Http\Requests\UpdateConfeitariaRequest;
use App\Services\ViaCepService;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


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

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string',
            'cep' => 'required|string',
            'rua' => 'required|string',
            'numero' => 'required|string',
            'bairro' => 'required|string',
            'cidade' => 'required|string',
            'estado' => 'required|string',
        ]);

        Confeitaria::create($data);

        return redirect()->route('confeitarias.index')->with('success', 'Confeitaria criada com sucesso!');
    }

    public function show(Confeitaria $confeitaria)
    {
        $confeitaria->load('produtos'); // carrega os produtos junto

        return Inertia::render('Confeitarias/Show', [
            'confeitaria' => $confeitaria,
            'produtos' => $confeitaria->produtos, // aqui envia os produtos!
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
