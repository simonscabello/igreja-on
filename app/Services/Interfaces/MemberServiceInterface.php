<?php

namespace App\Services\Interfaces;

use App\Models\Member;

interface MemberServiceInterface
{
    public function all(): array;

    public function find(int $id): ?Member;

    public function findWith(array $relations, int $id): ?Member;

    public function create(array $data): Member;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
