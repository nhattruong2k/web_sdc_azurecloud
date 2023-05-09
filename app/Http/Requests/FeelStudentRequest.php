<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeelStudentRequest extends FormRequest
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
            'name' => 'required|min:3',
            'avatar' => 'required_without:id|image|mimes:jpg,jpeg,png',
            'content' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'avatar.required_without' => __("feel_students.validation.avatar_required-without"),
            'avatar.image' => __("feel_students.validation.avatar_image"),
            'avatar.mimes' => __("feel_students.validation.avatar_mimes"),
            'name.required' => __("feel_students.validation.name_required"),
            'name.min' => __("feel_students.validation.name_min", ["amount" => 3] ),
            'content.required' => __("feel_students.validation.content_required"),
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' =>  __("feel_students.name"),
            'avatar' => __("feel_students.avatar"),
            'content' => __("feel_students.content"),
        ];
    }
}
