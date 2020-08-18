<?php namespace codicastudio\LaravelMixpanel\Listeners;

use codicastudio\LaravelMixpanel\Events\MixpanelEvent as Mixpanel;
use Illuminate\Auth\Events\Logout as LogoutEvent;

class Logout
{
    public function handle(LogoutEvent $logout)
    {
        if (config("services.mixpanel.enable-default-tracking")) {
            event(new Mixpanel($logout->user, ['User Logged Out' => []]));
        }
    }
}
