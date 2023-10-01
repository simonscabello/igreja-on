<?php

namespace App\Repositories;

use App\Models\Address;
use App\Repositories\Interfaces\AddressRepositoryInterface;

class AddressRepository implements AddressRepositoryInterface
{
    private function filterFillableData(array $data): array
    {
        return array_intersect_key($data, array_flip((new Address())->getFillable()));
    }

    public function all(): array
    {
        return Address::all()->toArray();
    }

    public function find(int $id): ?Address
    {
        return Address::find($id);
    }

    public function create(array $data): Address
    {
        $filteredData = $this->filterFillableData($data);

        return Address::create($filteredData);
    }

    public function update(int $id, array $data): bool
    {
        $filteredData = $this->filterFillableData($data);

        return (bool) Address::find($id)->update($filteredData);
    }

    public function delete(int $id): bool
    {
        return (bool) Address::find($id)->delete();
    }
}
