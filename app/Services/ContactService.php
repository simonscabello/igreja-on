<?php

namespace App\Services;

use App\Models\Contact;
use App\Services\Interfaces\ContactServiceInterface;
use App\Repositories\Interfaces\ContactRepositoryInterface;

class ContactService implements ContactServiceInterface
{
    public function __construct(private readonly ContactRepositoryInterface $contactRepository)
    {
    }

    public function create(array $data): Contact
    {
        return $this->contactRepository->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->contactRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->contactRepository->delete($id);
    }
}
