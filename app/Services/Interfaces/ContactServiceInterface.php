<?php

namespace App\Services\Interfaces;

use App\Models\Contact;

interface ContactServiceInterface
{
    public function create(array $data): Contact;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
