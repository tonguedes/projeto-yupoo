<?php

namespace App\Http\Requests\Categoria;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categorias', 'nome'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'Informe o nome da categoria.',
            'nome.unique'   => 'Já existe uma categoria com esse nome.',
        ];
    }
}
