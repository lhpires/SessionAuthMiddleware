<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('master.loginForm');
    }

    public function attempt(Request $request)
    {
        $credentials = [
            "email" => $request->get('email'),
            "password" => $request->get('password')
        ];

        // Retorna True ou False
        $attempt = Auth::attempt($credentials);
        if($attempt){
            Session::regenerateToken();
            return redirect()->route('master.dashboard');
        }

        return back()->withErrors([
            'message' => "Os dados informados não conferem!"
        ])->withInput($request->only('email'));

    }

    public function logout()
    {
        Auth::logout();
        Session::invalidate();
        Session::regenerateToken();

        return redirect()->route('master.login');
    }

    public function dashboard()
    {
        return view('master.dashboard');
    }
}
