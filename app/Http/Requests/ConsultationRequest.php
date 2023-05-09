<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'year_of_birth' => 'required',
            'course_id' => 'required',
            'ip_address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('consultations.validation.name_empty'),
            'name.required' => trans('consultations.validation.name_max'),
            'email.required' => trans('consultations.validation.email_empty'),
            'email.email' => trans('consultations.validation.email_format'),
            'phone.required' => trans('consultations.validation.phone_empty'),
            'address.required' => trans('consultations.validation.address_empty'),
            'year_of_birth.required' => trans('consultations.validation.year_of_birth_empty'),
            'course_id.required' => trans('consultations.validation.course_empty'),
            'ip_address.required' => trans('consultations.validation.ip_address_empty'),
        ];
    }
}
