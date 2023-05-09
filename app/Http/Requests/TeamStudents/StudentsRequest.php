<?php

namespace App\Http\Requests\TeamStudents;

use Illuminate\Foundation\Http\FormRequest;

class StudentsRequest extends FormRequest
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
            'fullname' => 'required|min:5,'.$this->id.',id,deleted_at,NULL',
            'avatar' => 'image|mimes:jpeg,png,jpg|dimensions:ratio=4/4',
            'position' => 'required|min:3',
            'workplace' => 'required|min:3',
        ];
    }
    public function messages()
    {
        return [
            'fullname.required' => __('student.fullname_required'),
            'fullname.min'=>__('student.fullname_min'),
            'avatar.image' =>__('student.avatar_image'),
            'image.mimes' =>__('student.image_mimes'),
            'avatar.dimensions'=>__('student.avatar_dimensions'),
            'position.required' => __('student.position_required'),
            'position.min'=>__('student.position_min'),
            'workplace.required' => __('student.workplace_required'),
            'workplace.min'=>__('student.workplace_min'),
        ];
    }
}
