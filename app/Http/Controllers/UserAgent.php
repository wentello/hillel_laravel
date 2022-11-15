<?php

namespace App\Http\Controllers;

class UserAgent{
    public function index(){
//        dd($userAgent = request()->userAgent());
        dd((new UserAgentInfo)());
    }
}

