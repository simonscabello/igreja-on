<?php

namespace App\Repositories;

use App\Models\Member;
use App\Repositories\Interfaces\MemberRepositoryInterface;

class MemberRepository implements MemberRepositoryInterface
{
    private function filterFillableData(array $data): array
    {
        return array_intersect_key($data, array_flip((new Member())->getFillable()));
    }

    public function all(): array
    {
        return Member::all()->toArray();
    }

    public function find(int $id): ?Member
    {
        return Member::find($id);
    }

    public function findWith(array $relations, int $id): ?Member
    {
        return Member::with($relations)->find($id)->get();
    }

    public function create(array $data): Member
    {
        $filteredData = $this->filterFillableData($data);

        return Member::create($filteredData);
    }

    public function update(int $id, array $data): bool
    {
        $filteredData = $this->filterFillableData($data);

        return (bool) Member::find($id)->update($filteredData);
    }

    public function delete(int $id): bool
    {
        return (bool) Member::find($id)->delete();
    }
}
