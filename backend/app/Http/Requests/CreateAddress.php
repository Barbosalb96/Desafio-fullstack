<?php

namespace App\Http\Requests;

use App\Domain\Cliente\Entities\Pessoa;
use App\Domain\Cliente\Entities\TipoEndereco;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAddress extends FormRequest
{
    public function rules(): array
    {
        return [
            'pessoa_id' => ['required', Rule::exists(Pessoa::class, 'id')],
            'cep' => ['required', 'string', 'min:8', 'max:9'],
            'logradouro' => ['required', 'string', 'min:2', 'max:255'],
            'numero' => ['required', 'string', 'min:1', 'max:10'],
            'complemento' => ['required', 'string', 'min:2', 'max:255'],
            'bairro' => ['required', 'string', 'min:2', 'max:255'],
            'cidade' => ['required', 'string', 'min:2', 'max:255'],
            'estado' => ['required', 'string', 'min:2', 'max:255'],
            'tipo_endereco_id' => ['required', Rule::exists(TipoEndereco::class, 'id')],
        ];
    }
}
