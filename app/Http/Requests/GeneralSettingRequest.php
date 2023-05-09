<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralSettingRequest extends FormRequest
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
            'logo' => 'mimes:jpg,png,jpeg',
            'favicon' => 'mimes:jpg,png,jpeg',
            'thumbnail' => 'mimes:jpg,png,jpeg',
            'content_introduce' => 'required|min:8',
            'use_name' => 'regex:/(.+)@(.+)\.(.+)/i',
            'from_address' => 'regex:/(.+)@(.+)\.(.+)/i',
            'password' => 'min:6',
        ];
    }

    public function messages()
    {
        return [
            'logo' => trans('common.validation.mimes'),
            'favicon' => trans('common.validation.mimes'),
            'thumbnail' => trans('common.validation.mimes'),
            'content_introduce.required' => trans('general_settings.validation.content_required'),
            'content_introduce.min' => trans('general_settings.validation.content_minlength'),
            'use_name.regex' => trans('general_settings.validation.use_name_regex'),
            'from_address.regex' => trans('general_settings.validation.from_address_regex'),
            'password.min' => trans('general_settings.validation.password_min', ['amount' => 6]),
        ];
    }
}
