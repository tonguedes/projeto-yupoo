<?php

namespace App\Http\Requests\Produto;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProdutoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

   public function rules(): array
{
    return [
        'categoria_id' => ['required', 'exists:categorias,id'],
        'nome'         => ['required', 'string', 'max:255'],
        'codigo'       => ['nullable', 'string', 'max:255'],
        'descricao'    => ['nullable', 'string'],

        'capa'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

        'imagens'      => ['nullable', 'array'],

        'imagens.*'    => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048',
        ],
    ];
}

    public function messages(): array
    {
        return [
    'categoria_id.required' => 'Selecione uma categoria.',
    'categoria_id.exists'   => 'Categoria inválida.',

    'nome.required'         => 'Informe o nome do produto.',

    'capa.image'            => 'A capa deve ser uma imagem.',
    'capa.max'              => 'A capa deve ter no máximo 2MB.',

    'imagens.array'         => 'Envie uma lista válida de imagens.',
    'imagens.*.image'       => 'Cada arquivo deve ser uma imagem.',
    'imagens.*.mimes'       => 'As imagens devem ser JPG, JPEG, PNG ou WEBP.',
    'imagens.*.max'         => 'Cada imagem deve ter no máximo 2MB.',
];
    }
}
