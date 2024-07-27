<?php

namespace App\Domain\Cliente\Repositories;

use App\Domain\Cliente\Entities\Pessoa;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ClientRepository
{
    public function __construct(
        private readonly Pessoa $pessoaModel,
    ) {}

    public function filter(array $filters): Collection|array
    {
        return $this->pessoaModel->query()
            ->withCount('endereco')
            ->when(! empty($filters['search']), function ($query) use ($filters) {
                $query->where('nome', 'like', "%{$filters['search']}%")
                    ->orWhere('cpf', $filters['search'])
                    ->orWhere('id', $filters['search']);
            })
            ->get();
    }

    public function findByClient(string $uuid): Model|Builder
    {
        return $this->pessoaModel->query()->with(['endereco' => function ($endereco) {
            $endereco->orderBy('id', 'desc');
        }])
            ->where('id_public', $uuid)
            ->firstOrFail();
    }

    public function store(array $data): Model|Builder
    {
        return $this->pessoaModel->query()->create($data);
    }

    public function update(string $id, array $data)
    {
        $pessoa = $this->pessoaModel->where('id_public', $id)->firstOrFail();
        $pessoa->update($data);

        return $pessoa;
    }

    public function deleteAddress($client)
    {
        $client->endereco->map(function ($address) {
            $address->delete();
        });
    }
}
