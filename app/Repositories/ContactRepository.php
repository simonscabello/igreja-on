<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Repositories\Interfaces\ContactRepositoryInterface;

class ContactRepository implements ContactRepositoryInterface
{
    private function filterFillableData(array $data): array
    {
        return array_intersect_key($data, array_flip((new Contact())->getFillable()));
    }

    public function create(array $data): Contact
    {
        $filteredData = $this->filterFillableData($data);

        return Contact::create($filteredData);
    }

    public function update(int $id, array $data): bool
    {
        $filteredData = $this->filterFillableData($data);

        return (bool) Contact::find($id)->update($filteredData);
    }

    public function delete(int $id): bool
    {
        return (bool) Contact::find($id)->delete();
    }
}
