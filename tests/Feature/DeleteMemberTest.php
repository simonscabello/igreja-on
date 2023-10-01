<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Member;
use App\Models\Address;
use App\Models\Contact;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteMemberTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete_member(): void
    {
        $member = Member::factory()->create();
        $address = Address::factory()->create(['member_id' => $member->id]);
        $contact = Contact::factory()->create(['member_id' => $member->id]);

        $response = $this->delete(route('members.destroy', $member));

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHas('success', trans('member.messages.member_deleted'));
        $response->assertRedirect(route('members.index'));

        $member = Member::find($member->id);
        $address = Address::find($address->id);
        $contact = Contact::find($contact->id);

        $this->assertNull($member);
        $this->assertNull($address);
        $this->assertNull($contact);
    }
}
