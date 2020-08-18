<?php namespace codicastudio\LaravelMixpanel\Providers;

use codicastudio\LaravelMixpanel\LaravelMixpanel;
use codicastudio\LaravelMixpanel\Listeners\Login as LoginListener;
use codicastudio\LaravelMixpanel\Listeners\LoginAttempt;
use codicastudio\LaravelMixpanel\Listeners\Logout as LogoutListener;
use codicastudio\LaravelMixpanel\Listeners\LaravelMixpanelUserObserver;
use codicastudio\LaravelMixpanel\Console\Commands\Publish;
use codicastudio\LaravelMixpanel\Events\MixpanelEvent;
use codicastudio\LaravelMixpanel\Listeners\MixpanelEvent as MixpanelEventListener;
use Illuminate\Contracts\View\View;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\HTTP\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class Service extends EventServiceProvider
{
    protected $defer = false;
    protected $listen = [
        MixpanelEvent::class => [MixpanelEventListener::class],
        Attempting::class => [LoginAttempt::class],
        Login::class => [LoginListener::class],
        Logout::class => [LogoutListener::class],
    ];

    public function boot()
    {
        parent::boot();

        include __DIR__ . '/../../routes/api.php';

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'codicastudio-mixpanel');
        $this->publishes([
            __DIR__ . '/../../public' => public_path(),
        ], 'assets');

        if (config('services.mixpanel.enable-default-tracking')) {
            $authModel = config('auth.providers.users.model') ?? config('auth.model');
            $this->app->make($authModel)->observe(new LaravelMixpanelUserObserver());
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/services.php', 'services');
        $this->commands(Publish::class);
        $this->app->singleton('mixpanel', LaravelMixpanel::class);
    }

    public function provides() : array
    {
        return ['codicastudio-mixpanel'];
    }
}
