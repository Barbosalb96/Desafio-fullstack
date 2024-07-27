<?php

namespace App\Domain\Cliente\Transform;

use App\Domain\Cliente\Entities\Pessoa;

class TransformAddress
{
    public static function handle($endereco, Pessoa $pessoa)
    {
        return [
            'cep' => $endereco['cep'] ?? '',
            'logradouro' => $endereco['logradouro'] ?? '',
            'numero' => $endereco['numero'] ?? '',
            'complemento' => $endereco['complemento'] ?? '',
            'bairro' => $endereco['bairro'] ?? '',
            'cidade' => $endereco['cidade'] ?? '',
            'estado' => $endereco['estado'] ?? '',
            'tipo_endereco_id' => $endereco['tipo_endereco_id'] ?? '',
            'pessoa_id' => $pessoa->id,
        ];
    }
}
