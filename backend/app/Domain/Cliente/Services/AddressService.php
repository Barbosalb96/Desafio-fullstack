<?php

namespace App\Domain\Cliente\Services;

use App\Domain\Cliente\Repositories\AddressRepository;

class AddressService
{
    public function __construct(
        private readonly AddressRepository $addressRepository
    )
    {
    }

    public function filter()
    {
        return $this->addressRepository->filter();
    }

    public function store(array $data)
    {
        return $this->addressRepository->store($data);
    }

    public function getAddress(int $id)
    {
        return $this->addressRepository->getAddress($id);
    }
}
