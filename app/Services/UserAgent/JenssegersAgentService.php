<?php

namespace App\Services\UserAgent;

use Jenssegers\Agent\Agent;

class JenssegersAgentService implements UserAgentInterface
{
    private $agent;

    public function __construct()
    {
        $this->agent = new Agent();
    }

    public function getBrowser(): string
    {

        $browser = $this->agent->browser();
        return $browser;
    }

    public function getOS(): string
    {
        $platform = $this->agent->platform();
        return $platform;
    }
}
