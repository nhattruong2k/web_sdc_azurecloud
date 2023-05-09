<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigRequest extends FormRequest
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
            'key' => 'required_without:id|min:3|unique:config,key,'  .$this->id. ',id,deleted_at,NULL',
            'value' => 'required|max: 255',
        ];
    }

    /**
     * Get the error messages for the defined validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'key.required_without' => __("config.validation.key_required-without"),
            'value.required' => __("config.validation.value_required"),
            'key.unique' => __("config.validation.key_unique"),
            'key.min' => __("config.validation.key_min", ['amount' => 3]),
            'value.max' =>  __("config.validation.max_length"),
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
            'key' =>  __("config.key"),
            'value' => __("config.value"),
        ];
    }
}
