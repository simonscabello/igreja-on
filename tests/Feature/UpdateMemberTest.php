<?php

namespace Tests\Feature;

use JsonException;
use Tests\TestCase;
use App\Models\Member;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateMemberTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @throws JsonException
     */
    public function test_update_member(): void
    {
        $member = Member::factory()->create();

        $updatedData = [
            'name' => 'New Name',
            'email' => 'new_email@example.com',
            'phone' => '1234567890',
        ];

        $route = route('members.update', $member);

        $response = $this->put($route, $updatedData);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHas(
            'success',
            trans('member.messages.member_updated', [
                'name' => $updatedData['name']]
            )
        );
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('members.edit', $member));

        $this->assertDatabaseHas('members', $updatedData);
    }

    public function test_required_fields()
    {
        $member = Member::factory()->create();

        $updatedData = [
            'name' => '',
        ];

        $route = route('members.update', $member);

        $response = $this->put($route, $updatedData);

        $response->assertSessionHasErrors(['name']);
    }

    public function test_validation_rules(): void
    {
        $member = Member::factory()->create();

        $updatedData = [
            'name' => str_repeat('A', 256),
            'email' => 'invalid-email',
            'phone' => str_repeat('1', 256),
        ];

        $route = route('members.update', $member);

        $response = $this->put($route, $updatedData);

        $response->assertSessionHasErrors(['name', 'email', 'phone']);
    }
}
