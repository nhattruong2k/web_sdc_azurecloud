<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkRequest extends FormRequest
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
            'title' => 'required|min:4|max:100',
            'course_category_id' => 'required',
            'time' => 'required',
            'degree' => 'required',
            'object' => 'required',
            'content' => 'required',
            'image' => 'mimes:jpeg,png,jpg',
            'keyword' => 'required|max:165',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => trans('works.validation.title_empty'),
            'title.min' => trans('works.validation.title_min', ['amount' => 4]),
            'title.max' => trans('works.validation.title_max', ['amount' => 100]),
            'title.unique' => trans('works.validation.title_exist'),
            'course_category_id.required' => trans('works.validation.course_category_id_empty'),
            'time.required' => trans('works.validation.time_empty'),
            'degree.required' => trans('works.validation.degree_empty'),
            'object.required' => trans('works.validation.object_empty'),
            'content.required' => trans('works.validation.content_empty'),
            'image.mimes' => trans('common.validation.mimes'),
            'keyword.required' => trans('works.validation.keyword_empty'),
            'keyword.max' => trans('works.validation.keyword_max'),
            'description.min' => trans('works.validation.description_min', ['amount' => 5]),
            'description.max' => trans('works.validation.description_max', ['amount' => 165]),
        ];
    }
}
