<?php

namespace App\Providers;

use App\Guards\BasicGuard;
use Illuminate\Support\ServiceProvider;

class BasicGuardProvider extends ServiceProvider
{
    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['auth']->extend('basic', function ($app, $name, array $config) {
            $provider = $app['auth']->createUserProvider($config['provider'] ?? null);

            $guard = new BasicGuard($name, $provider);

            if (method_exists($guard, 'setDispatcher')) {
                $guard->setDispatcher($this->app['events']);
            }

            if (method_exists($guard, 'setRequest')) {
                $guard->setRequest($this->app->refresh('request', $guard, 'setRequest'));
            }

            // Return an instance of Illuminate\Contracts\Auth\Guard...
            return $guard;
        });
    }
}
