<?php

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

Route::get('/', function () {
	return view('master');
});

Route::post('/board', function() {
    return view('master');
});

Route::get('/assets/{file}', function ($file) {
     
    $attributes = explode('.', $file);
	$type = $attributes[array_key_last($attributes)];
    
	$header = [	'js' => 'application/javascript',
	    'css' => 'text/css',
	    'svg' => 'image/svg+xml',
	    'ttf' => 'font/ttf'
    ];

    $isAsset = Storage::disk('public')->exists($file);

    $content = $isAsset ? Storage::disk('public')->get($file) : "/*not found*/";
    $status = $isAsset ? 200 : 404;

    return response($content, $status)->header('Content-Type', $header[$type] );
});