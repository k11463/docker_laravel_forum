<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUser extends FormRequest
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
            'username' => 'required|string|unique:users|max:8',
            'email' => 'required|string|email|unique:users', // unique:users 會去檢查users表單有沒有重複的email，如果有的話就回傳錯誤
            'password' => 'required|string|confirmed|between:6,12|regex:/(?=.*\d)(?=.*[a-zA-Z])(?=.*\W)/'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => '使用者名稱不可為空',
            'username.max' => '使用者名稱最大不可超過8個字',
            'username.unique' => '已經有人取過這個使用者名稱了',
            'email.required' => 'Email不可為空',
            'email.email' => 'Email格式錯誤',
            'email.unique' => 'Email申請過了',
            'password.required' => '密碼不可為空',
            'password.confirmed' => '密碼輸入不一致',
            'password.between' => '密碼需介於6-12位數之間',
            'password.regex' => '密碼需包含英文大小寫、數字和特殊符號',
        ];
    }
}
