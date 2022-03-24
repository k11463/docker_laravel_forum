<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePost extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'category' => 'required',
            'title' => 'required',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'category.required' => '請選擇文章類別',
            'title.required' => '請輸入文章標題',
            'content.required' => '請輸入文章內容',
        ];
    }
}
