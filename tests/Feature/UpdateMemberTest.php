<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Member;
use App\Models\Address;
use App\Models\Contact;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateMemberTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_member(): void
    {
        $member = Member::factory()->create();
        $address = Address::factory()->create(['member_id' => $member->id]);
        $contact = Contact::factory()->create(['member_id' => $member->id]);

        $memberUpdate = Member::factory()->make();
        $addressUpdate = Address::factory()->make();
        $contactUpdate = Contact::factory()->make();

        $updatedData = array_merge($memberUpdate->toArray(), $addressUpdate->toArray(), $contactUpdate->toArray());

        $route = route('members.update', $member);

        $response = $this->put($route, $updatedData);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHas(
            'success',
            trans(
                'member.messages.member_updated',
                [
                'name' => $memberUpdate->name]
            )
        );
        $response->assertRedirect(route('members.edit', $member));

        $updatedMember = Member::find($member->id);

        $this->assertEquals($memberUpdate->name, $updatedMember->name);
        $this->assertEquals($memberUpdate->birth_date, $updatedMember->birth_date);
        $this->assertEquals($memberUpdate->gender, $updatedMember->gender);
        $this->assertEquals($memberUpdate->marital_status, $updatedMember->marital_status);
        $this->assertEquals($memberUpdate->identification_number, $updatedMember->identification_number);

        $this->assertEquals($contactUpdate->email, $updatedMember->contact()->email);
        $this->assertEquals($contactUpdate->phone, $updatedMember->contact()->phone);

        $this->assertEquals($addressUpdate->street, $updatedMember->address()->street);
        $this->assertEquals($addressUpdate->complement, $updatedMember->address()->complement);
        $this->assertEquals($addressUpdate->number, $updatedMember->address()->number);
        $this->assertEquals($addressUpdate->district, $updatedMember->address()->district);
        $this->assertEquals($addressUpdate->city, $updatedMember->address()->city);
        $this->assertEquals($addressUpdate->state, $updatedMember->address()->state);
        $this->assertEquals($addressUpdate->zipcode, $updatedMember->address()->zipcode);
    }

    public function test_required_fields()
    {
        $member = Member::factory()->create();

        $updatedData = [
            'name' => '',
        ];

        $route = route('members.update', $member);

        $response = $this->put($route, $updatedData);

        $response->assertSessionHasErrors(['name' => 'member.validation.name_required']);
    }

    public function test_name_validation_rules()
    {
        $member = Member::factory()->create();

        $updateRoute = route('members.update', $member);

        $response = $this->put($updateRoute, []);
        $response->assertSessionHasErrors(['name' => trans('member.validation.name_required')]);

        $response = $this->put($updateRoute, ['name' => '']);
        $response->assertSessionHasErrors(['name' => trans('member.validation.name_required')]);

        $response = $this->put($updateRoute, ['name' => str_repeat('A', 256)]);
        $response->assertSessionHasErrors(['name' => trans('member.validation.name_max')]);
    }

    public function test_email_validation_rules()
    {
        $member = Member::factory()->create();

        $updateRoute = route('members.update', $member);

        $response = $this->put($updateRoute, ['email' => 'emailinvalid']);
        $response->assertSessionHasErrors(['email' => trans('member.validation.email_email')]);
    }

    public function test_phone_validation_rules()
    {
        $member = Member::factory()->create();

        $updateRoute = route('members.update', $member);

        $response = $this->put($updateRoute, ['phone' => str_repeat('1', 256)]);
        $response->assertSessionHasErrors(['phone' => trans('member.validation.phone_max')]);

        $response = $this->put($updateRoute, ['phone' => str_repeat('1', 1)]);
        $response->assertSessionHasErrors(['phone' => trans('member.validation.phone_min')]);

        $response = $this->put($updateRoute, ['phone' => 123]);
        $response->assertSessionHasErrors(['phone' => trans('member.validation.phone_string')]);
    }

    public function test_gender_validation_rules()
    {
        $member = Member::factory()->create();

        $updateRoute = route('members.update', $member);

        $response = $this->put($updateRoute, ['gender' => 'invalid_gender']);
        $response->assertSessionHasErrors(['gender' => trans('member.validation.gender_enum')]);
    }

    public function test_birth_date_validation_rules()
    {
        $member = Member::factory()->create();

        $updateRoute = route('members.update', $member);

        $response = $this->put($updateRoute, ['birth_date' => 'invalid_birth_date']);
        $response->assertSessionHasErrors(['birth_date' => trans('member.validation.birth_date_date')]);

    }

    public function test_marital_status_validation_rules()
    {
        $member = Member::factory()->create();

        $updateRoute = route('members.update', $member);

        $response = $this->put($updateRoute, ['marital_status' => 'invalid_marital_status']);
        $response->assertSessionHasErrors(['marital_status' => trans('member.validation.marital_status_enum')]);
    }

    public function test_identification_number_validation_rules()
    {
        $member = Member::factory()->create();

        $updateRoute = route('members.update', $member);

        $response = $this->put($updateRoute, ['identification_number' => 123]);
        $response->assertSessionHasErrors(['identification_number' => trans('member.validation.identification_number_string')]);

        $response = $this->put($updateRoute, ['identification_number' => str_repeat('1', 256)]);
        $response->assertSessionHasErrors(['identification_number' => trans('member.validation.identification_number_max')]);

        $response = $this->put($updateRoute, ['identification_number' => str_repeat('1', 2)]);
        $response->assertSessionHasErrors(['identification_number' => trans('member.validation.identification_number_min')]);
    }

    public function test_street_validation_rules()
    {
        $member = Member::factory()->create();

        $updateRoute = route('members.update', $member);

        $response = $this->put($updateRoute, ['street' => str_repeat('A', 256)]);
        $response->assertSessionHasErrors(['street' => trans('member.validation.street_max')]);

        $response = $this->put($updateRoute, ['street' => 123123]);
        $response->assertSessionHasErrors(['street' => trans('member.validation.street_string')]);
    }

    public function test_number_validation_rules()
    {
        $member = Member::factory()->create();

        $updateRoute = route('members.update', $member);

        $response = $this->put($updateRoute, ['number' => str_repeat('A', 256)]);
        $response->assertSessionHasErrors(['number' => trans('member.validation.number_max')]);

        $response = $this->put($updateRoute, ['number' => 123123]);
        $response->assertSessionHasErrors(['number' => trans('member.validation.number_string')]);
    }

    public function test_district_validation_rules()
    {
        $member = Member::factory()->create();

        $updateRoute = route('members.update', $member);

        $response = $this->put($updateRoute, ['district' => str_repeat('A', 256)]);
        $response->assertSessionHasErrors(['district' => trans('member.validation.district_max')]);

        $response = $this->put($updateRoute, ['district' => 123123]);
        $response->assertSessionHasErrors(['district' => trans('member.validation.district_string')]);
    }

    public function test_city_validation_rules()
    {
        $member = Member::factory()->create();

        $updateRoute = route('members.update', $member);

        $response = $this->put($updateRoute, ['city' => str_repeat('A', 256)]);
        $response->assertSessionHasErrors(['city' => trans('member.validation.city_max')]);

        $response = $this->put($updateRoute, ['city' => 123123]);
        $response->assertSessionHasErrors(['city' => trans('member.validation.city_string')]);
    }

    public function test_state_validation_rules()
    {
        $member = Member::factory()->create();

        $updateRoute = route('members.update', $member);

        $response = $this->put($updateRoute, ['state' => str_repeat('A', 3)]);
        $response->assertSessionHasErrors(['state' => trans('member.validation.state_max')]);

        $response = $this->put($updateRoute, ['state' => 123123]);
        $response->assertSessionHasErrors(['state' => trans('member.validation.state_string')]);
    }

    public function test_zip_code_validation_rules()
    {
        $member = Member::factory()->create();

        $updateRoute = route('members.update', $member);

        $response = $this->put($updateRoute, ['zip_code' => str_repeat('A', 256)]);
        $response->assertSessionHasErrors(['zip_code' => trans('member.validation.zip_code_max')]);

        $response = $this->put($updateRoute, ['zip_code' => 123123]);
        $response->assertSessionHasErrors(['zip_code' => trans('member.validation.zip_code_string')]);
    }

    public function test_complement_validation_rules()
    {
        $member = Member::factory()->create();

        $updateRoute = route('members.update', $member);

        $response = $this->put($updateRoute, ['complement' => str_repeat('A', 256)]);
        $response->assertSessionHasErrors(['complement' => trans('member.validation.complement_max')]);

        $response = $this->put($updateRoute, ['complement' => 123123]);
        $response->assertSessionHasErrors(['complement' => trans('member.validation.complement_string')]);
    }
}
