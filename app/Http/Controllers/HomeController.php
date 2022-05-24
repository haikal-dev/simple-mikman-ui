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
            return redirect('/login');
        }

        else {
			$user = $mikman->loadUser($request->session()->get($mikman->sessionName));

            return view('index')
                ->with('title', $mikman->appName)
                ->with('version', $mikman->version)
				->with('username', $user->username);
        }
    }
	
	public function logout(Request $request){
		$request->session()->flush();
		
		return redirect('/');
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
				$user->update_login_access();
                $request->session()->put($mikman->sessionName, $user->response->userid);
                
                return redirect('/');
            }
        }
    }

    public function signup(Request $request){
        $mikman = new Mikman();

        return view('register')
            ->with('title', $mikman->appName)
            ->with('version', $mikman->version);
    }

    public function confirm_signup(Request $request){
        $mikman = new Mikman();

        if(!$request->has('username', 'password', 'rpassword')){
            return view('register')
                ->with('title', $mikman->appName)
                ->with('version', $mikman->version)
                ->with('error', 'Invalid parameter');
        }

        else {
            
            // double check if password & rpassword are match
            if($request->get('password') != $request->get('rpassword')){
                return view('register')
                    ->with('title', $mikman->appName)
                    ->with('version', $mikman->version)
                    ->with('error', 'Password and retype password did not match. Please double check before re-submit again.');
            }

            else {
                // check in db if username already exist or not
                $user = new MikmanUser();
                if($user->exists($request->get('username'))){
                    return view('register')
                        ->with('title', $mikman->appName)
                        ->with('version', $mikman->version)
                        ->with('error', 'Username that you entered is already exists. Try something else.');
                }

                else {
                    if(!$user->register(
                        $request->get('username'),
                        $request->get('password')
                    )){
                        return view('register')
                            ->with('title', $mikman->appName)
                            ->with('version', $mikman->version)
                            ->with('error', 'This system has some glitch. Please ask developer to take a look.');
                    }

                    else {
                        return view('register')
                            ->with('title', $mikman->appName)
                            ->with('version', $mikman->version)
                            ->with('success', 'Well done! Please go to login area to log in with your new account!');
                    }
                }
            }
        }
    }
}
