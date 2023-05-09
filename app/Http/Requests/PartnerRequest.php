<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnerRequest extends FormRequest
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
            'title' => 'required|min:3|unique:partners,title,'  .$this->id. ',id,deleted_at,NULL',
            'image' => 'required_without:id|image|mimes:jpg,png,jpeg',
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
            'image.required_without' => __("partners.validation.image_required-without"),
            'image.image' => __("partners.validation.image_image"),
            'image.mimes' => __("partners.validation.image_mimes"),
            'title.required' => __("partners.validation.title_required"),
            'title.unique' => __("partners.validation.title_unique"),
            'title.min' => __("partners.validation.title_min", ["amount" => 3] ),
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
            'title' =>  __("partners.title"),
            'image' => __("partners.image"),
        ];
    }
}
