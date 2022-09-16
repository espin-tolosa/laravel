<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
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
     * Check if a POST request identify a valid user
     * by comparing with server database
     */
    public static function checkUser(Request $request)
    {
        $isUser = $request->get('user') === 'samuel';
        $isPass = $request->get('password') === 'freesolo';

        return $isUser && $isPass;
    }

    public static function path(Request $request)
    {
        return '/'.'samuel';
    }
}
