<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MikmanUserController as Mikman;

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
}
