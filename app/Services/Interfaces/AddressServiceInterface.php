<?php

namespace App\Services\Interfaces;

use App\Models\Address;

interface AddressServiceInterface
{
    public function create(array $data): Address;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
