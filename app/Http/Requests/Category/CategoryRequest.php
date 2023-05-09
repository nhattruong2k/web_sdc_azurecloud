<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'title' => 'required|min:5|max:100|unique:categories,title,'.$this->id.',id,deleted_at,NULL',
            'summary' => 'max:255',
            'image' => 'image|mimes:jpeg,png,jpg',
            'order_by' => 'required|max:3|regex:/^([0-9\s\-\+\(\)]*)$/',
        ];
    }
    public function messages()
    {
        return [
            'title.min' =>__('category.min'),
            'title.required' => __('category.title_required'),
            'title.unique' =>  __('category.title_unique'),
            'title.max' =>  __('category.title_maxlength'),
            'summary.max'=>__('category.summary_maxlength'),
            'image.image'=> __('category.image_image'),
            'image.mimes' => __('category.image_mimes'),
            'order_by.required' => __("category.order_by_required"),
            'order_by.max' => __("category.order_by_maxlength"),
            'order_by.regex' => __("category.order_by-regex"),
        ];
    }
}
