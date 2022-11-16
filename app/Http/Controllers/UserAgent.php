<?php

namespace App\Http\Controllers;

use Hillel\AgentUser\Test\UserAgentInterface;

class UserAgent{
    public function index(UserAgentInterface $userAgent){
//        dd($userAgent = request()->userAgent());
        dd((new UserAgentInfo)($userAgent));
    }
}

