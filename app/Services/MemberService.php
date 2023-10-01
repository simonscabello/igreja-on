<?php

namespace App\Services;

use App\Models\Member;
use App\Services\Interfaces\MemberServiceInterface;
use App\Repositories\Interfaces\MemberRepositoryInterface;

class MemberService implements MemberServiceInterface
{
    public function __construct(
        private readonly MemberRepositoryInterface $memberRepository,
        private readonly AddressService $addressService,
        private readonly ContactService $contactService,
    ) {
    }

    public function all(): array
    {
        return $this->memberRepository->all();
    }

    public function find(int $id): ?Member
    {
        return $this->memberRepository->find($id);
    }

    public function findWith(array $relations, int $id): ?Member
    {
        return $this->memberRepository->findWith($relations, $id);
    }

    public function create(array $data): Member
    {
        $member = $this->memberRepository->create($data);

        $data['member_id'] = $member->id;

        $this->addressService->create($data);
        $this->contactService->create($data);

        return $member;
    }

    public function update(int $id, array $data): bool
    {
        $member = $this->find($id);

        $this->addressService->update($member->address()->id, $data);
        $this->contactService->update($member->contact()->id, $data);

        return $this->memberRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->memberRepository->delete($id);
    }
}
