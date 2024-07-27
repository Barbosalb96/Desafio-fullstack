<?php

namespace App\Http\Requests;

use App\Domain\Cliente\Entities\Pessoa;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClientRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'nome_social' => ['nullable', 'string', 'max:255'],
            'cpf' => ['required', 'cpf', 'max:11', Rule::unique(Pessoa::class, 'id')],
            'telefone' => ['required', 'digits:11'],
            'nome_pai' => ['required', 'string', 'min:2', 'max:255'],
            'nome_mae' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique(Pessoa::class, 'email')],

        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'cpf' => preg_replace('/\D/', '', $this->input('cpf')),
        ]);
    }
}
