<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BenefitRequest extends FormRequest
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
            'icon' => 'required_without:id|image|mimes:png',
            'image' => 'required_without:id|image|mimes:jpg,png,jpeg',
            'title' => 'required|max:255|min:6|unique:benefit_students,title,'  .$this->id. ',id,deleted_at,NULL',
            'content' => 'required'
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
            'icon.required_without' =>  __("benefits.validation.icon_required-without"),
            'image.required_without' => __("benefits.validation.image_required-without"),
            'icon.image' => __("benefits.validation.icon_image"),
            'image.image' => __("benefits.validation.image_img"),
            'icon.mimes' => __("benefits.validation.icon_mimes"),
            'image.mimes' => __("benefits.validation.image_img"),
            'title.required' => __("benefits.validation.title_required"),
            'title.min' => __("benefits.validation.title_min", ['amount' => 6]),
            'title.unique' => __("benefits.validation.title_unique", ['title' => $this->title]),
            'content.required' => __("benefits.validation.content_required"),
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
            'title' =>  __("benefits.title"),
            'image' => __("benefits.image"),
            'icon' => __("benefits.icon"),
            'content' => __("benefits.content"),
        ];
    }
}
