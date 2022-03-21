<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class MikmanUser
{
    protected $table = 'mikman_users';
    protected $response;

    public function __construct(){

        // init standard class for response
        $this->response = new \StdClass();

        // define default status
        $this->response->status = false;
    }

    public function login($username, $password){
        
        // not exists!
        if(!$this->exists($username)){
            $this->response->message = "This " . $username . " was not exist in the system.";
        }

        // if exist, perform authentication
        else {
            $user = DB::table($this->table)->where('username', $username)->first();
            if($user['password'] != $password){
                $this->response->message = "Invalid authentication.";
            }

            else {
                $this->response->status = true;
            }
        }

        return $this->response->status;
    }
}
