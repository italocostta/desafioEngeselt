<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConfeitariaRequest extends FormRequest
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
        'nome'     => ['required','string','max:255'],
        'telefone' => ['nullable','string','max:20'],
        'cep'      => ['required','regex:/^\d{5}-?\d{3}$/'],
        'rua'      => ['required','string','max:255'],
        'numero'   => ['required','string','max:20'],
        'bairro'   => ['required','string','max:255'],
        'cidade'   => ['required','string','max:255'],
        'estado'   => ['required','string','size:2'],
    ];
}

}
