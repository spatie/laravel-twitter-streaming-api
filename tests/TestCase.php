<?php

namespace Spatie\LaravelTwitterStreamingApi\Test;

use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\LaravelTwitterStreamingApi\TwitterStreamingApiFacade;
use Spatie\LaravelTwitterStreamingApi\TwitterStreamingApiServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            TwitterStreamingApiServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('laravel-twitter-streaming-api', [
            'api_key' => 'my_api_key',
            'api_secret_key' => 'my_api_secret_key',
            'bearer_token' => 'my_bearer_token',
            'handle' => 'my_twitter_handle',
        ]);
    }

    protected function getPackageAliases($app): array
    {
        return [
            'TwitterStreamingApi' => TwitterStreamingApiFacade::class,
        ];
    }
}
