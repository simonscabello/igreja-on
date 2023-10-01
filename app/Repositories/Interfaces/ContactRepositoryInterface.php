<?php

namespace App\Repositories\Interfaces;

use App\Models\Contact;

interface ContactRepositoryInterface
{
    public function create(array $data): Contact;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
