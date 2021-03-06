<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MikmanUser
{
    protected $table = 'accounts';
    public $response;

    public function __construct(){

        // init standard class for response
        $this->response = new \StdClass();

        // define default status
        $this->response->status = false;
    }
	
	public function loadUser($userid){
		$user = DB::table($this->table)->where('id', $userid)->first();
		return $user;
	}

    public function login($username, $password){
        
        // not exists!
        if(!$this->exists($username)){
            $this->response->message = $username . " was not exist in the system.";
        }

        // if exist, perform authentication
        else {
            $user = DB::table($this->table)->where('username', $username)->first();
            if(!Hash::check($password, $user->password)){
                $this->response->message = "Invalid authentication.";
            }

            else {
				$this->response->userid = $user->id;
                $this->response->status = true;
            }
        }

        return $this->response->status;
    }
	
	public function update_login_access(){
		return DB::table($this->table)->where('id', $this->response->userid)->update([
			'logged_in_at' => time()
		]);
	}

    public function register($username, $password){
        return DB::table($this->table)->insert([
            'username' => $username,
            'password' => Hash::make($password),
            'created_at' => time(),
            'logged_in_at' => '0'
        ]);
    }

    public function exists($username){
        $user = DB::table($this->table)->where('username', $username)->first();

        if(isset($user->id)){
            return true;
        }

        return false;
    }
}
