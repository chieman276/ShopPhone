<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $user;

    public function login()
    {
        return view('backend.login.index');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('administrator/login');
    }

    // public function postLogin(LoginRequest $request)
    // {
    //     $email = $request->email;
    //     $password = $request->password;
    //     $checkUserByEmail = User::where('email',$email)->take(1)->first();
    //     if ($checkUserByEmail && Hash::check($request->password,$checkUserByEmail->password)) {
    //         Auth::login($checkUserByEmail);
    //         return redirect()->route('backend.home');
    //     } else {
    //         Session::flash('error_email','Đăng nhập không thành công');
    //         return redirect()->back();
    //     }

    // }
    public function postLogin(Request $request)
    {

        $data = $request->only('email', 'password');
        // dd(Hash::make(123456789));
        // dd($data);
        if (Auth::attempt($data)) {
            return redirect()->route('backend.home');
        } else {
            Session::flash('error_phone', 'Đăng nhập không thành công');
            return redirect('administrator/login');
        }
    }
}
