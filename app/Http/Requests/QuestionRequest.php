<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'question' => 'required|min:20|max:300|unique:questions,question,'  .$this->id. ',id,deleted_at,NULL',
            'answer' => 'required|min:20|max:500',
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
            'question.required' => trans("questions.validation.question_empty"),
            'question.min' => trans("questions.validation.question_min", ['amount' => 20]),
            'question.max' => trans("questions.validation.question_max", ['amount' => 300]),
            'question.unique' => trans("questions.validation.question_exist"),
            'answer.required' => trans("questions.validation.answer_empty"),
            'answer.min' => trans("questions.validation.answer_min", ['amount' => 20]),
            'answer.max' => trans("questions.validation.answer_max", ['amount' => 500]),
        ];
    }
}
