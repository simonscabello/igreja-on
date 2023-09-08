<?php

namespace App\Services;

use App\Models\Member;
use App\Repositories\Interfaces\MemberRepositoryInterface;

class MemberService
{
    public function __construct(private readonly MemberRepositoryInterface $memberRepository)
    {
    }

    public function all(): array
    {
        return $this->memberRepository->all();
    }

    public function find(int $id): ?Member
    {
        return $this->memberRepository->find($id);
    }

    public function create(array $data): Member
    {
        return $this->memberRepository->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->memberRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->memberRepository->delete($id);
    }
}
