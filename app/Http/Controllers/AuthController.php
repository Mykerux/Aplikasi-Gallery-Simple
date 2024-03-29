<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() {
        return view('login');
    }

    public function register() {
        return view('register');
    }

    public function postLogin(Request $request) {
        if (Auth::attempt($request->only('email', 'username', 'password'))) {
            return redirect('/gallery');
        } else {
            return back()->with('alert', 'Ada data yang salah!');
        }   

    }

    public function postRegister(Request $request) {
        $email = User::where('email', $request->email)->first();
        if ($email) {
            return back()->with('alert', 'Email sudah terdaftar!');
        }

        if ($request->password == $request->repassword) {
            $ins = User::create([
                'name'=>$request->name,
                'username'=>$request->username,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
            ]);

            Auth::login($ins);
            return redirect()->intended('/gallery');
        }

        return back()->with('alert', 'Password tidak sama!');
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}