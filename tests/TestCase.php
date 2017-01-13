<?php

namespace Spatie\LaravelTwitterStreamingApi\Test;

use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\LaravelTwitterStreamingApi\TwitterStreamingApiFacade;
use Spatie\LaravelTwitterStreamingApi\TwitterStreamingApiServiceProvider;

abstract class TestCase extends Orchestra
{
    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            TwitterStreamingApiServiceProvider::class,
        ];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('laravel-twitter-streaming-api', [
            'access_token' => 'my_access_token',
            'access_token_secret' => 'my_access_token_secret',
            'consumer_key' => 'my_consumer_key',
            'consumer_secret' => 'my_consumer_secret',
        ]);
    }

    protected function getPackageAliases($app)
    {
        return [
            'TwitterStreamingApi' => TwitterStreamingApiFacade::class,
        ];
    }
}
