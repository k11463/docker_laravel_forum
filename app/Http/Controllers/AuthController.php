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
            'account.required' => '記得填寫帳號欄位喔!!',
            'password.required' => '記得填寫密碼欄位喔!!',
        ]);
        // dd($request->user()); 因為沒有登入成功 所以找不到這筆資料
        $fieldType = filter_var($validatedData['account'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $arrayData = array($fieldType => $validatedData['account'], 'password' => $validatedData['password']);
        if (!Auth::attempt($arrayData)){
            return response('帳號或密碼錯誤', 401);
        }
        $user = $request->user(); // 如果登入成功 會自動找到這筆資料
        // dd($user);

        // createToken是passport裡面的方法 會為我們建立一個token
        $tokenResult = $user->createToken('brian');
        $tokenResult->token->save();
        return response(['token' => $tokenResult->accessToken]);
    }

    public function user(Request $request){
        return response($request->user());
    }
}
