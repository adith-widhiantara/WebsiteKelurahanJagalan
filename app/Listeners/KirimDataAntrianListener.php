<?php

namespace App\Listeners;

use App\Events\PanggilAntrianEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class KirimDataAntrianListener
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
     * @param  PanggilAntrianEvent  $event
     * @return void
     */
    public function handle(PanggilAntrianEvent $event)
    {
        return 'hallo listener';
    }
}
