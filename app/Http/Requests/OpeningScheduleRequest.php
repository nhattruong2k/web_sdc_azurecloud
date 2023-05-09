<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OpeningScheduleRequest extends FormRequest
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
            'course_id' => 'required|unique:opening_schedules,course_id,'  .$this->id. ',id,deleted_at,NULL',
            'lecturers' => 'required',
            'tuition' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'course_id.required' => trans('opening_schedules.validation.course_empty'),
            'course_id.unique' => trans('opening_schedules.validation.course_exist'),
            'lecturers.required' => trans('opening_schedules.validation.lecturers_empty'),
            'tuition.required' => trans('opening_schedules.validation.tuition_empty'),
        ];
    }
}
