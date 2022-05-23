<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    public function index(Request $request)
    {
       
        return view('admin.login');
    }

    public function checkLogin(Request $request)
    {

        $validated = $request->validate([
            'email'=> 'required|email',
            'password'=> 'required|min:6',
        ]);
        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            return true;
        } else {
            return response()->json(
                [
                    'error' => 'Email hoặc mật khẩu sai', 
                ]
            );
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
