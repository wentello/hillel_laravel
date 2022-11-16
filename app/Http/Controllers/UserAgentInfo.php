<?php

namespace App\Http\Controllers;

use App\Models\UserAgent as UserAgentModel;
use Hillel\AgentUser\Test\UserAgentInterface;
use \Hillel\AgentUserMatomo\Test\MatomoService;
use Hillel\UserAgentJenssegers\Test\JenssegersAgentService;


class UserAgentInfo
{
    /*public function __construct(UserAgentInterface $userAgent)
    {
        return $this->getUserAgent($userAgent);
    }*/

    public function __invoke(UserAgentInterface $userAgent)
    {
        return $this->getUserAgent($userAgent);
//        return $this->getUserAgent(new JenssegersAgentService());
//        return $this->getUserAgent(new MatomoService());
    }

    private function getUserAgent(UserAgentInterface $userAgent)
    {
        $data = [
            'browser' => $userAgent->getBrowser(),
            'os' => $userAgent->getOS()
        ];
        UserAgentModel::create($data);
        return $data;
    }
}
