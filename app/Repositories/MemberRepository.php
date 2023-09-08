<?php

namespace App\Repositories;

use App\Models\Member;
use App\Repositories\Interfaces\MemberRepositoryInterface;

class MemberRepository implements MemberRepositoryInterface
{

    public function all(): array
    {
        return Member::all()->toArray();
    }

    public function find(int $id): ?Member
    {
        return Member::find($id);
    }

    public function create(array $data): Member
    {
        return Member::create($data);
    }

    public function update(int $id, array $data): bool
    {
        return (bool) Member::find($id)->update($data);
    }

    public function delete(int $id): bool
    {
        return (bool) Member::find($id)->delete();
    }
}
