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

// dashboard
Route::get('/', [Home::class, 'index']);

// login
Route::get('/login', [Home::class, 'login']);
Route::post('/login', [Home::class, 'login']);

// logout session
Route::get('/logout', [Home::class, 'logout']);

// register
Route::get('/signup', [Home::class, 'signup']);
Route::post('/signup', [Home::class, 'confirm_signup']);

