<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Http\Requests\LoginUserRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role',
        'password',
        'style',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Check if a user has valid authentication tokens
     * which identifies him as user
     * 
     */
    public static function isAuth(Request $request) {
        /**
         * Future logic of authentication, querying DB
         */
        return $request->cookie('auth') ? true : false;
    }

    /**
     * isURIOfAuthUser:
     * 
     * This protects our route in case of someone tries to force a request with another user name
     * typing it directly in the http bar of the web browser
     * 
     * It checks if the cookie set by authenticate route is the requested one,
     * so only allow to pass one URI among any other possiblity, which is the one signed by authenticate route
     * 
     * As this is a get request, this way is protects
     * 
     * TODO: move this to a static method of User model
     */
    public static function isURIOfAuthUser(Request $request, string $userURI)
    {
        return $userURI === $request->cookie('auth');
    }

    //public static function 
}
