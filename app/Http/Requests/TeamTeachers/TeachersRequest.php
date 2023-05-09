<?php

namespace App\Http\Requests\TeamTeachers;

use Illuminate\Foundation\Http\FormRequest;

class TeachersRequest extends FormRequest
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
            'profession' => 'required|min:3',
            'role'=>'required',
            'description' => 'required|min:8',
        ];
    }
    public function messages()
    {
        return [
            'fullname.required' => __('teacher.fullname_required'),
            'fullname.min'=>__('teacher.fullname_min'),
            'avatar.image' =>__('teacher.avatar_image'),
            'avatar.dimensions'=>__('teacher.avatar_dimensions'),
            'image.mimes' =>__('teacher.image_mimes'),
            'role.required'=>__('teacher.role_required'),
            'profession.required' => __('teacher.profession_required'),
            'profession.min'=>__('teacher.profession_min'),
            'description.required' => __('teacher.description_required'),
            'description.min'=>__('teacher.description_min'),
        ];
    }
}
?>