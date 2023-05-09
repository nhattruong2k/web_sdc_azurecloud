<?php

namespace App\Http\Requests\New;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'title' => 'required|min:3|unique:news,title,'.$this->id.',id,deleted_at,NULL',
            'summary' => 'required|min:15|max:255',
            'content' => 'required|min:8',
            'image' => 'required_without:id|image|mimes:jpg,png,jpeg',
            'category_id' =>'required',
            'created_at'=>'required',
            'keyword'=>'required|max:165',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => __('news.title_required'),
            'title.unique' => __('news.title_unique'),
            'title.min'=>__('news.title_min'),
            'summary.required' => __('news.summary_required'),
            'summary.min'=>__('news.summary_min'),
            'summary.max'=>__('news.summary_max'),
            'content.required' =>__('news.content_required'),
            'content.min' =>__('news.content_minlength'),
            'image.required' =>__('news.image_required'),
            'image.required_without' => __("news.image_required-without"),
            'image.mimes' =>__('news.image_mimes'),
            'category_id.required'=>__('news.category_required'),
            'created_at.required'=>__('news.created_at'),
            'keyword.required'=>__('news.keyword_required'),
            'keyword.max'=>__('news.keyword_maxlength'),
        ];
    }
}
