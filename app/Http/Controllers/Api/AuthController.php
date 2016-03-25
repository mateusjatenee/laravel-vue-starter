<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $credentials = $request->only(['name', 'email', 'password']);
        $credentials['password'] = bcrypt($credentials['password']);

        $user = User::create($credentials);
        return $user;
    }
}
