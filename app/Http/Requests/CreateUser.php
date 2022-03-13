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
            'user_name' => 'required|string|unique:users|min:4|max:10',
            'email' => 'required|string|email|unique:users', // unique:users 會去檢查users表單有沒有重複的email，如果有的話就回傳錯誤
            'password' => 'required|string|confirmed|min:6|max:12'
        ];
    }

    public function messages()
    {
        return [
            'user_name.required' => '使用者名稱不可為空',
            'user_name.min' => '使用者名稱需大於等於4個字',
            'user_name.max' => '使用者名稱需小於等於10個字',
            'user_name.unique' => '已經有人取過這個使用者名稱了',
            'email.required' => 'Email不可為空',
            'email.email' => 'Email格式錯誤',
            'email.unique' => 'Email申請過了',
            'password.required' => '密碼不可為空',
            'password.confirmed' => '密碼輸入不一致',
            'password.min' => '密碼需<6個字',
            'password.max' => '密碼需>6個字'
        ];
    }
}
