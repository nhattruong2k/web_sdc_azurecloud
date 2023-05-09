<?php

namespace App\Http\Requests;

use App\Models\Banners;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BannersRequest extends FormRequest
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
            'title' => 'required|max:255|min:6|unique:banners,title,'  .$this->id. ',id,deleted_at,NULL',
            'link' => 'required_without:id|image|mimes:jpg,png,jpeg',
            'description' => 'max:255',
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
            'title.required' => __("banners.validation.title_required"),
            'title.max' => __("banners.validation.title_max", ['amount' => 255]),
            'link.required' => __("banners.validation.link_required"),
            'link.image' => __("banners.validation.link_image"),
            'link.mimes' => __("banners.validation.link_mimes"),
            'title.unique' => __("banners.validation.title_unique"),
            'title.min' => __("banners.validation.title_min", ['amount' => 6]),
            'link.required_without' => __("banners.validation.link_required-without"),
            'description.max' => __("banners.validation.description_max", ['amount' => 255]),
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
        'title' =>  __("banners.title"),
        'link' => __("banners.link"),
    ];
}
}
