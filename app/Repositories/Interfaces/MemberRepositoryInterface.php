<?php

namespace App\Repositories\Interfaces;

use App\Models\Member;

interface MemberRepositoryInterface
{
    public function all(): array;

    public function find(int $id): ?Member;

    public function create(array $data): Member;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
