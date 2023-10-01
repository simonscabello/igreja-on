<?php

namespace App\Repositories\Interfaces;

use App\Models\Address;

interface AddressRepositoryInterface
{
    public function create(array $data): Address;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
