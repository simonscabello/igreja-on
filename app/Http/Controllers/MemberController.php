<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Member;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Services\Interfaces\MemberServiceInterface;

class MemberController extends Controller
{
    public function __construct(private readonly MemberServiceInterface $memberService)
    {
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreMemberRequest $request): RedirectResponse
    {
        try {
            $member = $this->memberService->create($request->validated());

            session()->flash('success', trans('member.messages.member_created', ['name' => $member->name]));

            return to_route('members.edit', ['member' => $member]);
        } catch (Exception $exception) {
            session()->flash(
                'error',
                trans('member.messages.member_not_created', ['message' => $exception->getMessage()])
            );

            return back()->withInput();
        }
    }

    public function show(Member $member)
    {
        //
    }

    public function edit(Member $member)
    {
        //
    }

    public function update(UpdateMemberRequest $request, Member $member): RedirectResponse
    {
        try {
            $this->memberService->update($member->id, $request->validated());

            session()->flash('success', trans('member.messages.member_updated'));

            return to_route('members.edit', ['member' => $member]);
        } catch (Exception $exception) {
            session()->flash(
                'error',
                trans('member.messages.member_not_updated', [
                    'message' => $exception->getMessage(),
                ])
            );

            return back()->withInput();
        }
    }

    public function destroy(Member $member): RedirectResponse
    {
        try {
            $this->memberService->delete($member->id);

            session()->flash('success', trans('member.messages.member_deleted'));

            return to_route('members.index');
        } catch (Exception $exception) {
            session()->flash(
                'error',
                trans('member.messages.member_not_deleted', [
                    'message' => $exception->getMessage(),
                ])
            );

            return back();
        }
    }
}
