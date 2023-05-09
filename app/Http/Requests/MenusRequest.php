<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenusRequest extends FormRequest
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
            'title' => 'required|min:6|unique:menus,title,'. $this->id. ',id,deleted_at,NULL',
            'order_by' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
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
            'title.required' => __("menus.validation.title_required"),
            'title.unique' => __("menus.validation.title_unique", ['title' => $this->title]),
            'title.min' => __("menus.validation.title_min", ['amount' => 6]),
            'order_by.required' => __("menus.validation.order_by-required"),
            'order_by.regex' => __("menus.validation.order_by-regex"),
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
            'title' =>  __("menus.title"),
            'order_by' =>  __("menus.order_by"),
        ];
    }
}
