<?php

namespace App\Services\UserAgent;

interface UserAgentInterface
{
    public function getBrowser(): string;

    public function getOS(): string;
}
