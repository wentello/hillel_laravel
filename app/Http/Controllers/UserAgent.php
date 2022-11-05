<?php

namespace App\Http\Controllers;

use App\Services\UserAgent\JenssegersAgentService;
use App\Services\UserAgent\MatomoService;
use App\Services\UserAgent\UserAgentInterface;
use \App\Models\UserAgent as UserAgentModel;

class UserAgent
{
    public function __construct()
    {
//        dd($this->getUserAgent(new JenssegersAgentService()));
        dd($this->getUserAgent(new MatomoService()));
    }

    private function getUserAgent(UserAgentInterface $userAgent){
        $data = [
            'browser' => $userAgent->getBrowser(),
            'os' => $userAgent->getOS()
        ];
        UserAgentModel::create($data);
        return $data;
    }
}
