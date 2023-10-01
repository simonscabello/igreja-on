<?php

namespace App\Services;

use App\Models\Address;
use App\Services\Interfaces\AddressServiceInterface;
use App\Repositories\Interfaces\AddressRepositoryInterface;

class AddressService implements AddressServiceInterface
{
    public function __construct(private readonly AddressRepositoryInterface $addressRepository)
    {
    }

    public function create(array $data): Address
    {
        return $this->addressRepository->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->addressRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->addressRepository->delete($id);
    }
}
