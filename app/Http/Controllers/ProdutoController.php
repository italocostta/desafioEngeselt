<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\ProdutoImagem;
use App\Models\Confeitaria;
use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    public function create(Confeitaria $confeitaria)
    {
        return Inertia::render('Produtos/Form', [
            'initialData' => [
                'confeitaria_id' => $confeitaria->id,
                'nome' => '',
                'valor' => '',
                'descricao' => '',
            ]
        ]);
    }


    public function store(StoreProdutoRequest $request)
    {
        $data = $request->validated();

        $produto = Produto::create([
            'confeitaria_id' => $data['confeitaria_id'],
            'nome' => $data['nome'],
            'valor' => $data['valor'],
            'descricao' => $data['descricao'] ?? '',
        ]);

        // Se tiver imagens, salva
        if ($request->hasFile('imagens')) {
            foreach ($request->file('imagens') as $imagem) {
                $path = $imagem->store('produtos', 'public');
                ProdutoImagem::create([
                    'produto_id' => $produto->id,
                    'caminho' => $path,
                ]);
            }
        }

        return redirect()->route('confeitarias.show', $produto->confeitaria_id)
            ->with('success', 'Produto criado com sucesso!');
    }

    public function edit(Produto $produto)
    {
        return Inertia::render('Produtos/Form', [
            'initialData' => $produto->load('imagens')->toArray(),
        ]);
    }

    public function update(UpdateProdutoRequest $request, Produto $produto)
    {
        $data = $request->validated();

        $produto->update([
            'nome' => $data['nome'],
            'valor' => $data['valor'],
            'descricao' => $data['descricao'] ?? '',
        ]);

        if ($request->hasFile('imagens')) {
            foreach ($request->file('imagens') as $imagem) {
                $path = $imagem->store('produtos', 'public');
                ProdutoImagem::create([
                    'produto_id' => $produto->id,
                    'caminho' => $path,
                ]);
            }
        }

        return redirect()->route('confeitarias.show', $produto->confeitaria_id)
            ->with('success', 'Produto atualizado!');
    }
    
    public function destroy(Confeitaria $confeitaria, Produto $produto)
    {
        $produto->delete();

        return redirect()
            ->route('confeitarias.produtos.index', $confeitaria)
            ->with('success', 'Produto excluído com sucesso!');
    }
}
