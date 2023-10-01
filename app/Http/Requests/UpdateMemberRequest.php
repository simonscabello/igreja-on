<?php

namespace App\Http\Requests;

use App\Enum\GenderEnum;
use App\Enum\MaritalStatusEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string', 'min:3', 'max:255'],
            'gender' => ['nullable', new Enum(GenderEnum::class)],
            'birth_date' => ['nullable', 'date'],
            'marital_status' => ['nullable', new Enum(MaritalStatusEnum::class)],
            'identification_number' => ['nullable', 'string', 'min:3', 'max:255'],
            'street' => ['nullable', 'string', 'max:255'],
            'number' => ['nullable', 'string', 'max:255'],
            'district' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:2'],
            'zip_code' => ['nullable', 'string', 'max:255'],
            'complement' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => trans('member.validation.name_required'),
            'name.string' => trans('member.validation.name_string'),
            'name.max' => trans('member.validation.name_max'),
            'email.email' => trans('member.validation.email_email'),
            'email.unique' => trans('member.validation.email_unique'),
            'phone.string' => trans('member.validation.phone_string'),
            'phone.max' => trans('member.validation.phone_max'),
            'phone.min' => trans('member.validation.phone_min'),
            'gender' => trans('member.validation.gender_enum'),
            'birth_date' => trans('member.validation.birth_date_date'),
            'marital_status' => trans('member.validation.marital_status_enum'),
            'identification_number.string' => trans('member.validation.identification_number_string'),
            'identification_number.max' => trans('member.validation.identification_number_max'),
            'identification_number.min' => trans('member.validation.identification_number_min'),
            'street.string' => trans('member.validation.street_string'),
            'street.max' => trans('member.validation.street_max'),
            'number.string' => trans('member.validation.number_string'),
            'number.max' => trans('member.validation.number_max'),
            'district.string' => trans('member.validation.district_string'),
            'district.max' => trans('member.validation.district_max'),
            'city.string' => trans('member.validation.city_string'),
            'city.max' => trans('member.validation.city_max'),
            'state.string' => trans('member.validation.state_string'),
            'state.max' => trans('member.validation.state_max'),
            'zip_code.string' => trans('member.validation.zip_code_string'),
            'zip_code.max' => trans('member.validation.zip_code_max'),
            'complement.string' => trans('member.validation.complement_string'),
            'complement.max' => trans('member.validation.complement_max'),
        ];
    }
}
