<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUser;
use App\Models\User;

class AuthController extends Controller
{
    public function signup(CreateUser $request)
    {
        // 檢查是否通過驗證
        $validatedData = $request->validated();
        // 建立一個空的model塞入傳過來的資料
        $user = new User([
            'user_name' => $validatedData['user_name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password'])
        ]);
        $user->save();
        return response('create success', 201);
    }
}
