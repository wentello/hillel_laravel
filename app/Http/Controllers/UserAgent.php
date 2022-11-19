<?php

namespace App\Http\Controllers;

use App\Jobs\setAgentInfo;
use Hillel\AgentUser\Test\UserAgentInterface;

class UserAgent{
    public function index(UserAgentInterface $userAgent){
        SetAgentInfo::dispatch($userAgent)->onQueue('parsing');
//        dd($userAgent = request()->userAgent());
//        dd((new UserAgentInfo)($userAgent));
    }
}

