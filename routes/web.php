<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\HomeController as Home;

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
Route::prefix('/')->group(function(){
    
    Route::get('', [Home::class, 'index']);
    Route::get('login', [Home::class, 'login']);
    Route::post('login', [Home::class, 'login']);

    Route::get('signup', [Home::class, 'signup']);
    Route::post('signup', [Home::class, 'confirm_signup']);
});

