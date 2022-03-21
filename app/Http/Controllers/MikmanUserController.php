<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MikmanUserController extends Controller
{
    public $sessionName = 'mikman_userid';
    public $appName = 'Mikman';
    public $version = 'v0.0.1-alpha2';

    public function __construct(){

    }
}
