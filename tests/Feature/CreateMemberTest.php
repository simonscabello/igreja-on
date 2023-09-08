<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateMemberTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_member(): void
    {
        $member = Member::factory()->make();

        $response = $this->post(route('members.store'), $member->toArray());

        $response->assertRedirect(route('members.index'));
        $response->assertSessionHas('success', trans('member.messages.member_created', ['name' => $member->name]));

        $this->assertDatabaseHas('members', $member->toArray());
    }

    public function test_required_fields(): void
    {
        $response = $this->post('/members', []);

        $response->assertSessionHasErrors(['name']);
    }

    public function test_validation_rules(): void
    {
        // Validation test for a member with all fields blank
        $response = $this->post('/members', []);
        $response->assertSessionHasErrors(['name']);

        // Validation test for a member with an empty name
        $response = $this->post('/members', ['name' => '']);
        $response->assertSessionHasErrors(['name']);

        // Validation test for a member with a very long name
        $response = $this->post('/members', ['name' => str_repeat('A', 256)]);
        $response->assertSessionHasErrors(['name']);

        // Validation test for a member with an invalid email
        $response = $this->post('/members', ['email' => 'emailinvalid']);
        $response->assertSessionHasErrors(['email']);

        // Validation test for a member with a duplicated email
        Member::factory()->create(['email' => 'email@example.com']);
        $response = $this->post('/members', ['email' => 'email@example.com']);
        $response->assertSessionHasErrors(['email']);

        // Validation test for a member with a very long phone number
        $response = $this->post('/members', ['phone' => str_repeat('1', 256)]);
        $response->assertSessionHasErrors(['phone']);
    }
}
