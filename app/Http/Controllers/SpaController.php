<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class SpaController extends Controller
{
    public function index(Request $request, string $name)
    {
        $isAuth = User::isAuth($request);
        $isURI = User::isURIOfAuthUser($request, $name);

        if(!$isAuth || !$isURI)
        {
            return redirect('/')->withCookie(Cookie::forget('auth')) ;
        }

        $role = User::where('name', $name)->value('role');

        return response(view($role));
    }
    //
}
