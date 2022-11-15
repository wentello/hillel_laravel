<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \Hillel\AgentUser\Test\UserAgentInterface;
use \Hillel\AgentUserMatomo\Test\MatomoService;
use Hillel\UserAgent\Test\JenssegersAgentService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserAgentInterface::class, function () {
            return new MatomoService();
//            return new JenssegersAgentService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
