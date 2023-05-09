<?php

namespace App\Http\Requests\Lookup;

use Illuminate\Foundation\Http\FormRequest;

class PointRequest extends FormRequest
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
            'type' => 'required',
            'key' => 'required',
            'value' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'Loại chứng chỉ không được để trống',
            'key.required' => 'Key không được để trống',
            'value.required' => 'Value không được để trống'
        ];
    }
}
