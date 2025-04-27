<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProdutoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
{
    return [
        'confeitaria_id' => ['required','exists:confeitarias,id'],
        'nome'           => ['required','string','max:255'],
        'valor'          => ['required','numeric','min:0'],
        'descricao'      => ['nullable','string'],
        'imagens.*'      => ['nullable','image','max:2048'], // cada arquivo até 2 MB
    ];
}

}
