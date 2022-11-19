<?php

namespace App\Jobs;

use App\Http\Controllers\UserAgentInfo;
use Hillel\AgentUser\Test\UserAgentInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SetAgentInfo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $userAgent;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(UserAgentInterface $userAgent)
    {
        $this->userAgent = $userAgent;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        (new UserAgentInfo)($this->userAgent);
    }
}
