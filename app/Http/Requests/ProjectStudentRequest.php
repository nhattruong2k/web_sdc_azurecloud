<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectStudentRequest extends FormRequest
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
            'title' => 'required|min:6|max:255|unique:project_students,title,'  .$this->id. ',id,deleted_at,NULL',
            'image' => 'required_without:id|image|mimes:jpg,png,jpeg',
            'link' => 'required|regex:/<iframe[^>]*src\s*=\s*"?https?:\/\/[^\s"\/]*youtube.com(?:\/[^\s"]*)?"?[^>]*>.*?<\/iframe>/i',
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
            'title.required' => __("project_students.validation.title_required"),
            'title.min' => __("project_students.validation.title_min", ['amount' => 6]),
            'title.unique' => __("project_students.validation.title_unique", ['title' => $this->title]),
            'image.image' => __("project_students.validation.image_img"),
            'image.mimes' => __("project_students.validation.image_mimes"),
            'image.required_without' => __("project_students.validation.image_required-without"),
            'title.max' => __("project_students.validation.title_max", ['amount' => 255]),
            'link.required' => __("project_students.validation.link_required"),
            'link.regex' => __("project_students.validation.link_regex"),
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
            'title' =>  __("project_students.title"),
            'image' => __("project_students.image"),
            'link' => __("project_students.link"),
        ];
    }
}
