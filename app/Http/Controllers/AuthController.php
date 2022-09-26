<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request)
    {
        $request->validated($request->all());

        $isAuth = Auth::attempt($request->only('name', 'password'));
        return $isAuth ? redirect('/')->withCookie('auth', $request->get('name')) :
            redirect('/');
    }

    public function register(StoreUserRequest $request)
    {
        $request->validated($request->all());

        $user = User::create([
            'name' => $request->get('name'),
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'style' => $request->style
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of ' . $user->name)->plainTextToken
        ]);


        return response()->json('This is register method');
    }

    public function logout()
    {
        $cookie = Cookie::forget('auth');
        return redirect('/')->withCookie($cookie);
    }
}
