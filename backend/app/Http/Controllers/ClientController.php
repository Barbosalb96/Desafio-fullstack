<?php

namespace App\Http\Controllers;

use App\Domain\Cliente\Services\AddressService;
use App\Domain\Cliente\Services\ClientService;
use App\Http\Requests\ClientRequestFilter;
use App\Http\Requests\CreateAddress;
use App\Http\Requests\StoreClientRequest;
use App\Http\Resources\AddressPessoaFindResource;
use App\Http\Resources\FilterClientResource;
use App\Http\Resources\FindAddressPessoaFindResource;
use App\Http\Resources\MessageDefaultResource;
use App\Http\Resources\TypeAddressResource;
use Illuminate\Http\JsonResponse;
use Throwable;

class ClientController extends Controller
{
    public function __construct(
        private readonly ClientService  $clientService,
        private readonly AddressService $addressService,
    )
    {
    }

    /**
     * @throws Throwable
     */
    public function index(ClientRequestFilter $clientRequestFilter): JsonResponse
    {
        try {
            $response = $this->clientService->filter($clientRequestFilter->validated());

            return FilterClientResource::collection($response)
                ->response();
        } catch (Throwable $throwable) {
            $this->badRequestResponse($throwable);
        }
    }

    /**
     * @throws Throwable
     */
    public function getTypeAddress(): JsonResponse
    {
        try {
            $response = $this->addressService->filter();

            return TypeAddressResource::collection($response)
                ->response();
        } catch (Throwable $throwable) {
            $this->badRequestResponse($throwable);
        }
    }

    /**
     * @throws Throwable
     */
    public function findByClient(string $uuid): JsonResponse
    {
        try {
            $response = $this->clientService->findByClient($uuid);

            return (new FindAddressPessoaFindResource($response))
                ->response();
        } catch (Throwable $throwable) {
            $this->badRequestResponse($throwable);
        }
    }

    public function getAddress(string $id): JsonResponse
    {
        try {
            $response = $this->addressService->getAddress($id);

            return (new AddressPessoaFindResource($response))
                ->response();
        } catch (Throwable $throwable) {
            $this->badRequestResponse($throwable);
        }
    }

    /**
     * @throws Throwable
     */
    public function store(StoreClientRequest $storeClienteRequest): JsonResponse
    {
        try {
            $this->clientService->store($storeClienteRequest->validated());
            $response = [
                'message' => 'Cliente cadastrado com sucesso',
            ];

            return (new MessageDefaultResource($response))
                ->response();
        } catch (Throwable $throwable) {
            $this->badRequestResponse($throwable);
        }
    }

    public function storeAddress(CreateAddress $createAddress)
    {
        try {
            $this->addressService->store($createAddress->validated());
            $response = [
                'message' => 'Cliente cadastrado com sucesso',
            ];

            return (new MessageDefaultResource($response))
                ->response();
        } catch (Throwable $throwable) {
            $this->badRequestResponse($throwable);
        }
    }
}
