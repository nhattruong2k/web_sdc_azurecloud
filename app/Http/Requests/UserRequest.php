<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [
            'name' => 'required|min:6|max:50',
            'avatar' => 'mimes:jpg,png,jpeg',
            'address'=>'max:100',
        ];

        if (empty($this->id)){
            $rules += [
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|same:password_confirmation',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => trans('users.name_empty'),
            'name.min' => trans('users.validation.name_min', ['amount' => 6]),
            'name.max' => trans('users.validation.name_max', ['amount' => 50]),
            'email.required' => trans('users.email_empty'),
            'email.email' => trans('users.email_format'),
            'email.unique' => trans('users.validation.email_exist'),
            'password.required' => trans('users.password_empty'),
            'password.min' => trans('users.validation.min_new_password', ['amount' => 6]),
            'password.same' => trans('users.validation.same_password'),
            'avatar.mimes' => __("common.validation.mimes"),
            'address.max'=> __("user.validation.address_max"),
        ];
    }
}
