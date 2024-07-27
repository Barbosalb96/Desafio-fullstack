<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressPessoaFindResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if (!empty($this->resource)) {
            return [
                'pessoa_id' => $this?->pessoa_id,
                'id_public' => $this?->id_public,
                'cep' => $this?->cep,
                'logradouro' => $this?->logradouro,
                'numero' => $this?->numero,
                'complemento' => $this?->complemento,
                'bairro' => $this?->bairro,
                'cidade' => $this?->cidade,
                'estado' => $this?->estado,
                'historico' => (bool)$this?->deleted_at,
                'pessoa_id' => $this?->pessoa_id,
                'tipo_endereco_id' => $this?->tipo_endereco_id,
            ];
        }
        return [];

    }

}
