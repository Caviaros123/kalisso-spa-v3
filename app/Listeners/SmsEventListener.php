<?php

namespace App\Listeners;

use App\Events\SmsNotify;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SmsEventListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SmsNotify  $event
     * @return void
     */
    public function handle(SmsNotify $event)
    {
        Log::info('=== TestEventListener  ========');
    }
}
