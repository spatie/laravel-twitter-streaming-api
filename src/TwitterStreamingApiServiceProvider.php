<?php

namespace Spatie\LaravelTwitterStreamingApi;

use Illuminate\Support\ServiceProvider;

class TwitterStreamingApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/laravel-twitter-streaming-api.php' => config_path('laravel-twitter-streaming-api.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-twitter-streaming-api.php', 'laravel-twitter-streaming-api');

        $this->app->bind('laravel-twitter-streaming-api', TwitterStreamingApi::class);
    }
}
