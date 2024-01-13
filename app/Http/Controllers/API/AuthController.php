<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function attempt(Request $request)
    {
        $credentials = [
            "email" => $request->get('email'),
            "password" => $request->get('password')
        ];

        // Retorna True ou False
        $attempt = Auth::attempt($credentials);
        if($attempt){
            return response()->json([
                "user" => Auth::user(),
                "token" => Auth::user()->createToken('authorization')->plainTextToken
            ]);
        }
        return response()->json([
            "message" => "Os dados não conferem"
        ],401);
    }

    public function logout() : void
    {
        $user = Auth::user();
        // $user->tokens()->delete(); // Exclui todos os tokens do usuário
        $user->currentAccessToken()->delete(); // Exclui apenas o token passado na requisição
    }
}
