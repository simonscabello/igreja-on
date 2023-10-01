<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Member;
use App\Models\Address;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateMemberTest extends TestCase
{
    use RefreshDatabase;

    protected string $storeRoute;

    protected function setUp(): void
    {
        parent::setUp();

        $this->storeRoute = route('members.store');
    }

    public function test_create_member(): void
    {
        $member = Member::factory()->make();
        $address = Address::factory()->make();
        $contact = Contact::factory()->make();

        $data = array_merge($member->toArray(), $address->toArray(), $contact->toArray());

        $response = $this->post($this->storeRoute, $data);

        $id = $this->extractIdFromUrl($response->headers->get('Location'));

        $storedMember = Member::find($id);

        $response->assertRedirect(route('members.edit', ['member' => $storedMember->id]));
        $response->assertSessionHas('success', trans('member.messages.member_created', ['name' => $member->name]));

        $this->assertEquals($member->name, $storedMember->name);
        $this->assertEquals($member->birth_date, $storedMember->birth_date);
        $this->assertEquals($member->gender, $storedMember->gender);
        $this->assertEquals($member->marital_status, $storedMember->marital_status);
        $this->assertEquals($member->identification_number, $storedMember->identification_number);

        $this->assertEquals($address->street, $storedMember->address()->street);
        $this->assertEquals($address->complement, $storedMember->address()->complement);
        $this->assertEquals($address->number, $storedMember->address()->number);
        $this->assertEquals($address->district, $storedMember->address()->district);
        $this->assertEquals($address->city, $storedMember->address()->city);
        $this->assertEquals($address->state, $storedMember->address()->state);
        $this->assertEquals($address->zipcode, $storedMember->address()->zipcode);

        $this->assertEquals($contact->email, $storedMember->contact()->email);
        $this->assertEquals($contact->phone, $storedMember->contact()->phone);

    }

    public function test_required_fields(): void
    {
        $response = $this->post($this->storeRoute, []);

        $response->assertSessionHasErrors(['name' => trans('member.validation.name_required')]);
    }

    public function test_name_validation_rules(): void
    {
        $response = $this->post('/members', []);
        $response->assertSessionHasErrors(['name' => trans('member.validation.name_required')]);

        $response = $this->post('/members', ['name' => '']);
        $response->assertSessionHasErrors(['name' => trans('member.validation.name_required')]);

        $response = $this->post('/members', ['name' => str_repeat('A', 256)]);
        $response->assertSessionHasErrors(['name' => trans('member.validation.name_max')]);
    }

    public function test_email_validation_rules(): void
    {
        $response = $this->post('/members', ['email' => 'emailinvalid']);
        $response->assertSessionHasErrors(['email' => trans('member.validation.email_email')]);
    }

    public function test_phone_validation_rules(): void
    {
        $response = $this->post('/members', ['phone' => str_repeat('1', 256)]);
        $response->assertSessionHasErrors(['phone' => trans('member.validation.phone_max')]);

        $response = $this->post('/members', ['phone' => str_repeat('1', 1)]);
        $response->assertSessionHasErrors(['phone' => trans('member.validation.phone_min')]);

        $response = $this->post('/members', ['phone' => 123]);
        $response->assertSessionHasErrors(['phone' => trans('member.validation.phone_string')]);
    }

    public function test_gender_validation_rules(): void
    {
        $response = $this->post('/members', ['gender' => 'invalid_gender']);
        $response->assertSessionHasErrors(['gender' => trans('member.validation.gender_enum')]);
    }

    public function test_birth_date_validation_rules(): void
    {
        $response = $this->post('/members', ['birth_date' => 'invalid_birth_date']);
        $response->assertSessionHasErrors(['birth_date' => trans('member.validation.birth_date_date')]);
    }

    public function test_marital_status_validation_rules(): void
    {
        $response = $this->post('/members', ['marital_status' => 'invalid_marital_status']);
        $response->assertSessionHasErrors(['marital_status' => trans('member.validation.marital_status_enum')]);
    }

    public function test_identification_number_validation_rules(): void
    {
        $response = $this->post('/members', ['identification_number' => 123]);
        $response->assertSessionHasErrors(['identification_number' => trans('member.validation.identification_number_string')]);

        $response = $this->post('/members', ['identification_number' => str_repeat('1', 256)]);
        $response->assertSessionHasErrors(['identification_number' => trans('member.validation.identification_number_max')]);

        $response = $this->post('/members', ['identification_number' => str_repeat('1', 2)]);
        $response->assertSessionHasErrors(['identification_number' => trans('member.validation.identification_number_min')]);
    }

    public function test_street_validation_rules(): void
    {
        $response = $this->post('/members', ['street' => str_repeat('A', 256)]);
        $response->assertSessionHasErrors(['street' => trans('member.validation.street_max')]);

        $response = $this->post('/members', ['street' => 123123]);
        $response->assertSessionHasErrors(['street' => trans('member.validation.street_string')]);
    }

    public function test_number_validation_rules(): void
    {
        $response = $this->post('/members', ['number' => str_repeat('A', 256)]);
        $response->assertSessionHasErrors(['number' => trans('member.validation.number_max')]);

        $response = $this->post('/members', ['number' => 123123]);
        $response->assertSessionHasErrors(['number' => trans('member.validation.number_string')]);
    }

    public function test_district_validation_rules(): void
    {
        $response = $this->post('/members', ['district' => str_repeat('A', 256)]);
        $response->assertSessionHasErrors(['district' => trans('member.validation.district_max')]);

        $response = $this->post('/members', ['district' => 123123]);
        $response->assertSessionHasErrors(['district' => trans('member.validation.district_string')]);
    }

    public function test_city_validation_rules(): void
    {
        $response = $this->post('/members', ['city' => str_repeat('A', 256)]);
        $response->assertSessionHasErrors(['city' => trans('member.validation.city_max')]);

        $response = $this->post('/members', ['city' => 123123]);
        $response->assertSessionHasErrors(['city' => trans('member.validation.city_string')]);
    }

    public function test_state_validation_rules(): void
    {
        $response = $this->post('/members', ['state' => str_repeat('A', 3)]);
        $response->assertSessionHasErrors(['state' => trans('member.validation.state_max')]);

        $response = $this->post('/members', ['state' => 123123]);
        $response->assertSessionHasErrors(['state' => trans('member.validation.state_string')]);
    }

    public function test_zip_code_validation_rules(): void
    {
        $response = $this->post('/members', ['zip_code' => str_repeat('A', 256)]);
        $response->assertSessionHasErrors(['zip_code' => trans('member.validation.zip_code_max')]);

        $response = $this->post('/members', ['zip_code' => 123123]);
        $response->assertSessionHasErrors(['zip_code' => trans('member.validation.zip_code_string')]);
    }

    public function test_complement_validation_rules(): void
    {
        $response = $this->post('/members', ['complement' => str_repeat('A', 256)]);
        $response->assertSessionHasErrors(['complement' => trans('member.validation.complement_max')]);

        $response = $this->post('/members', ['complement' => 123123]);
        $response->assertSessionHasErrors(['complement' => trans('member.validation.complement_string')]);
    }
}
