<?php

use App\Http\Controllers\AuthController;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request)
{
    $auth_user = $request->cookie('auth');

    return !User::isAuth($request) ? view('index') :
        redirect("/board/$auth_user");
});

/**
 * 
 */

Route::get('/board/{name}', function(Request $request, string $name)
{
    $isAuth = User::isAuth($request);
    $isURI = User::isURIOfAuthUser($request, $name);

    if(!$isAuth || !$isURI)
    {
        return redirect('/')->withCookie(Cookie::forget('auth')) ;
    }

    $role = User::where('name', $name)->value('role');

    return response(view($role));
});

Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/assets/{file}', function ($file)
{     
    $attributes = explode('.', $file);
	$type = $attributes[array_key_last($attributes)];
    
	$content_type = [	'js' => 'application/javascript',
	                    'css' => 'text/css',
	                    'svg' => 'image/svg+xml',
	                    'ttf' => 'font/ttf'
                    ];
	
    $max_age =      [	'js' => 'max-age=0',
	                    'css' => 'max-age=31536000',
	                    'svg' => 'max-age=31536000',
	                    'ttf' => 'max-age=31536000'
                    ];

    $isAsset = Storage::disk('public')->exists($file);

    $content = $isAsset ? Storage::disk('public')->get($file) : "/*not found*/";
    $status = $isAsset ? 200 : 404;

    return response($content, $status)
        ->header('Content-Type', $content_type[$type] )
        ->header('Cache-Control', $max_age[$type]) ;
});