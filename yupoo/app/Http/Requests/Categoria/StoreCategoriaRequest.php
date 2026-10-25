<?php

namespace App\Http\Requests\Categoria;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null
            && $this->user()->tenant_id !== null
            && in_array(
                $this->user()->role,
                ['tenant_admin', 'super_admin'],
                true
            );
    }

    public function rules(): array
    {
        $tenantId = $this->user()->tenant_id;

        return [
            'nome' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categorias', 'nome')
                    ->where('tenant_id', $tenantId),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'Informe o nome da categoria.',
            'nome.unique' => 'Já existe uma categoria com esse nome na sua empresa.',
            'nome.max' => 'O nome da categoria deve ter no máximo 255 caracteres.',
        ];
    }
}

