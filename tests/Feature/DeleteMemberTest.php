<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Member;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteMemberTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete_member(): void
    {
        $member = Member::factory()->create();

        $response = $this->delete(route('members.destroy', $member));

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHas('success', trans('member.messages.member_deleted'));
        $response->assertRedirect(route('members.index'));

        $this->assertDatabaseMissing('members', ['id' => $member->id]);
    }
}
