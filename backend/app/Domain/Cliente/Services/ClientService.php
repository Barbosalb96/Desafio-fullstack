<?php

namespace App\Domain\Cliente\Services;

use App\Domain\Cliente\Repositories\ClientRepository;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ClientService
{
    public function __construct(
        private readonly ClientRepository $clientRepository,
    ) {}

    public function filter(array $filter): Collection|array
    {
        return $this->clientRepository->filter($filter);
    }

    public function findByClient(string $uuid): Model|Builder
    {
        return $this->clientRepository->findByClient($uuid);
    }

    public function store(array $data): void
    {
        try {
            $this->clientRepository->store($data);

            return;
        } catch (Exception $exception) {
            Log::error($exception);
            throw new Exception($exception);
        }
    }
}
