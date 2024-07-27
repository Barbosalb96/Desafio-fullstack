<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilterClientResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'id_public' => $this->id_public,
            'nome' => $this->nome,
            'nome_social' => $this->nome_social,
            'cpf' => $this->cpf,
            'nome_pai' => $this->nome_pai,
            'nome_mae' => $this->nome_mae,
            'telefone' => $this->telefone,
            'email' => $this->email,
            'quantidade_endereco' => $this->endereco_count,
        ];
    }
}
