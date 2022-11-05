<?php

namespace App\Services\UserAgent;

use DeviceDetector\ClientHints;
use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\AbstractDeviceParser;
use DeviceDetector\Parser\Client\Browser;
use DeviceDetector\Parser\OperatingSystem;

class MatomoService implements UserAgentInterface
{
    private $dd;

    public function __construct()
    {
        AbstractDeviceParser::setVersionTruncation(AbstractDeviceParser::VERSION_TRUNCATION_NONE);

        $userAgent = $_SERVER['HTTP_USER_AGENT']; // change this to the useragent you want to parse
        $clientHints = ClientHints::factory($_SERVER); // client hints are optional

        $dd = new DeviceDetector($userAgent, $clientHints);

        $dd->parse();
        $this->dd = $dd;
    }

    public function getBrowser(): string
    {
        $browserFamily = Browser::getBrowserFamily($this->dd->getClient('name'));

        return $browserFamily;
    }

    public function getOS(): string
    {
        $osFamily = OperatingSystem::getOsFamily($this->dd->getOs('name'));
        return $osFamily;
    }
}
