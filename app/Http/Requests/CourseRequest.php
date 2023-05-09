<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'title' => 'required|min:4|max:100|unique:courses,title,'  .$this->id. ',id,deleted_at,NULL',
            'course_category_id' => 'required',
            'time' => 'required',
            'degree' => 'required',
            'object' => 'required',
            'content' => 'required',
            'image' => 'mimes:jpeg,png,jpg',
            'keyword' => 'required|max:165',
            'description' => 'required|min:5,max:165',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => trans('courses.validation.title_empty'),
            'title.min' => trans('courses.validation.title_min', ['amount' => 4]),
            'title.max' => trans('courses.validation.title_max', ['amount' => 100]),
            'title.unique' => trans('courses.validation.title_exist'),
            'course_category_id.required' => trans('courses.validation.course_category_id_empty'),
            'time.required' => trans('courses.validation.time_empty'),
            'degree.required' => trans('courses.validation.degree_empty'),
            'object.required' => trans('courses.validation.object_empty'),
            'content.required' => trans('courses.validation.content_empty'),
            'image.mimes' => __('common.validation.mimes'),
            'keyword.required' => __('courses.validation.keyword_empty'),
            'keyword.max' => __('courses.validation.keyword_maxlength'),
            'description.required' => __('courses.validation.description_empty'),
            'description.min' => __('courses.validation.description_minlength'),
            'description.max' => __('courses.validation.description_maxlength'),
        ];
    }
}
