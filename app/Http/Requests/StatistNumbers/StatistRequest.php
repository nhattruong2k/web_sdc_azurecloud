<?php

namespace App\Http\Requests\StatistNumbers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StatistRequest extends FormRequest
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
            'title' => 'required|min:5,'.$this->id.',id,deleted_at,NULL',
            'icon' => 'image|mimes:jpeg,png,jpg|dimensions:min_width=140,min_height=140,max_width=250,max_height=250',
            'figures' => 'required|min:2',
            //To do 'link'=>'required|regex:/^http(s)?:\/\/(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/'
        ];
    }
    public function messages()
    {
        return [
            'title.required' => __('statistnumber.title_required'),
            'title.min'=>__('statistnumber.title_min'),
            'icon.mimes' =>__('statistnumber.icon_mimes'),
            'icon.dimensions' =>__('statistnumber.icon_dimensions'),
            'figures.required'=>__('statistnumber.figures_required'),
            'figures.min'=>__('statistnumber.figures_min'),
            // Todo
            // 'link.required' => __("statistnumber.required"),
            // 'link.regex' => __("statistnumber.regex"),
        ];
    }

}
