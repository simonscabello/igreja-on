<?php

namespace App\Http\Requests;

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
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:members,email',
            'phone' => 'nullable|string|max:255',
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
        ];
    }
}
