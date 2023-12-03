<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        //validate datas from request
        $data = $request->validate([
            'name' => 'string|min:8|required',
            'email' => 'email|required|unique:users,email',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
            ],
        ]);

        //create user & token if data are correct
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'isSeller' => false
        ]);
        $token = $user->createToken('main')->plainTextToken;

        return response([
            'data' => $user,
            'token' => $token
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'email|required|exists:users,email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {
            return response([
                'errors' => 'The Provided credentials are not correct'
            ]);
        }

        $user = Auth::user();
        $token = $user->createToken('main')->plainTextToken;

        return response([
            'data' => $user,
            'token' => $token
        ]);
    }
}
