<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FindAddressPessoaFindResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->mountAddress($this->endereco);
    }

    private function mountAddress($address)
    {
        return $address->map(function ($address) {
            return [
                'pessoa_id' => $address->pessoa_id,
                'id_public' => $address->id_public,
                'cep' => $address->cep,
                'logradouro' => $address->logradouro,
                'numero' => $address->numero,
                'complemento' => $address->complemento,
                'bairro' => $address->bairro,
                'cidade' => $address->cidade,
                'estado' => $address->estado,
                'historico' => (bool) $address->deleted_at,
                'pessoa_id' => $address->pessoa_id,
                'tipo_endereco_id' => $address->tipo_endereco_id,
            ];
        })->values()->toArray();
    }
}
