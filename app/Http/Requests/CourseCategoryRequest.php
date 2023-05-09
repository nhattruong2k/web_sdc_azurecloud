<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseCategoryRequest extends FormRequest
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
            'title' => 'required|min:5|max:255|unique:categories,title,'.$this->id.',id,deleted_at,NULL',
            'summary' => 'max:255',
            'image' => 'mimes:jpeg,png,jpg',
            'order' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
        ];
    }

    public function messages()
    {
        return [
            'title.min' =>__('course_categories.validation.min'),
            'title.required' => __('course_categories.validation.title_required'),
            'title.unique' =>  __('course_categories.validation.title_unique'),
            'image.mimes' => __('common.validation.mimes'),
            'order.required' => __("course_categories.validation.order_required"),
            'order.regex' => __("course_categories.validation.order_by-regex"),
        ];
    }
}
