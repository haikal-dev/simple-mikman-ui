<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MikmanUserController as Mikman;
use App\Models\MikmanUser;

class HomeController extends Controller
{
    public function index(Request $request){
        $mikman = new Mikman();

        if(!$request->session()->has($mikman->sessionName)){
            return view('login')
            ->with('title', $mikman->appName)
            ->with('version', $mikman->version);
        }

        else {
            return view('index')
            ->with('title', $mikman->appName)
            ->with('version', $mikman->version);
        }
    }

    public function login(Request $request){
        $user = new MikmanUser();
        $mikman = new Mikman();

        if(!$request->has('username', 'password')){
            return view('login')
            ->with('title', $mikman->appName)
            ->with('version', $mikman->version)
            ->with('error', "Username & password are required!");
        }

        else {
            if(!$user->login(
                $request->get('username'),
                $request->get('password')
            )){
                return view('login')
                ->with('title', $mikman->appName)
                ->with('version', $mikman->version)
                ->with('error', $user->response->message);
            }

            else {
                $request->session()->put($user->response->userid);
                
                return redirect('/');
            }
        }
    }
}
