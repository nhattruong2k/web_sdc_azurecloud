<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'name' => 'required|min:4|max:50|unique:roles,name,'  .$this->id. ',id,deleted_at,NULL',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('roles.name_empty'),
            'name.min' => trans('roles.name_min', ['amount' => 4]),
            'name.max' => trans('roles.name_max', ['amount' => 50]),
            'name.unique' => trans('roles.name_exist'),
        ];
    }
}
