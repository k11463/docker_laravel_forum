<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function signup(CreateUser $request)
    {
        // 檢查是否通過驗證
        $validatedData = $request->validated();
        // 建立一個空的model塞入傳過來的資料
        $user = new User([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password'])
        ]);
        $user->save();
        return response('create success', 201);
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'account' => 'required',
            'password' => 'required'
        ],[
            'account.required' => '請輸入帳號',
            'password.required' => '請輸入密碼',
        ]);

        // dd($request->user()); 因為沒有登入成功 所以找不到這筆資料

        // 驗證account是否為EMAIL如果 是 回傳'email'如果 不是 回傳'username'
        $fieldType = filter_var($validatedData['account'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $arrayData = array($fieldType => $validatedData['account'], 'password' => $validatedData['password']);
        // 判斷帳號密碼是否正確 如果不正確 回傳401
        if (!Auth::attempt($arrayData)){
            return response('帳號或密碼錯誤', 401);
        }
        $user = $request->user(); // 如果登入成功 會自動找到這筆資料

        // createToken是passport裡面的方法 會為我們建立一個token
        $tokenResult = $user->createToken('brian');
        $tokenResult->token->save();
        return response([
            'token' => $tokenResult->accessToken,
            'username' => $user->username
        ]);
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke(); // revoke = 讓token直接失效
        return response(
            ['message' => '登出成功']
        );
    }

    public function checkToken(Request $request){
        $request->user();
        return 'pass';
    }
}
