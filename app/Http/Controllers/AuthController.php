<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
            'isSeller' => false
        ]);

        //create user & token if data are correct
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'isSeller' => $data['isSeller'],
        ]);
        $token = $user->createToken('main')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ]);
    }
}
