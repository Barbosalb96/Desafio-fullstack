<?php

namespace App\Domain\Cliente\Repositories;

use App\Domain\Cliente\Entities\Endereco;
use App\Domain\Cliente\Entities\TipoEndereco;

class AddressRepository
{
    public function __construct(
        private readonly Endereco     $enderecoModel,
        private readonly TipoEndereco $tipoEndereco,
    )
    {
    }

    public function filter()
    {
        return $this->tipoEndereco->all();
    }

    public function store(array $data)
    {
        $address = $this->enderecoModel->where('pessoa_id', $data['pessoa_id'])->first();
        if ($address) {
            $address->delete();
        }
        return $this->enderecoModel->query()->create($data);
    }

    public function getAddress(int $id)
    {
        return $this->enderecoModel->where('pessoa_id', $id)->first();
    }
}
