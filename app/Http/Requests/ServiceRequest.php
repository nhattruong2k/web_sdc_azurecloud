<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'title' => 'required|min:5',
            'logo' => 'mimes:png,jpg,jpeg',
            'description' => 'required',
//            'link' => 'required|regex:/^http(s)?:\/\/(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/',
        ];

        if ($this->id){
            $rules += [
                'logo' => 'required',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => trans('services.validation.title_empty'),
            'title.min' => trans('services.validation.title_min', ['amount' => 5]),
            'logo.required' => trans('services.validation.logo_empty'),
            'logo.mimes' => trans('services.validation.logo_mimes'),
            'description.required' => trans('services.validation.description_empty'),
            'link.required' => trans('services.validation.link_empty'),
            'link.regex' => trans('services.validation.link_regex'),
        ];
    }
}
