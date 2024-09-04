<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginRegisterController extends Controller
{
    //
    public function showLoginPage(){
        return view('Login');
    }

    public function showRegisterPage(){
        return view('Register');
    }


    public function StoreRegister(Request $request){
        $request->validate([
            'name' => 'required|min:3|max:40',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:12',
            'phone' => 'required|regex:/^08[0-9]{8,12}$/',
        ]);

        $protectedPassword = bcrypt($request->password);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $protectedPassword,
            'phone' => $request->phone,
        ]);

        return redirect('/login');
    }

    public function StoreLogin(Request $request){
        $credentials = $request->validate([
            'email' => 'required|ends_with:@gmail.com',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }
        else{
            return redirect()->back()->withErrors(['login_error' => 'Email or password is incorrect.']);
        }
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/home'); 
    }
}
