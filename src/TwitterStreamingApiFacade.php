<?php

namespace Spatie\LaravelTwitterStreamingApi;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Spatie\TwitterStreamingApi\PublicStream publicStream()
 * @method static \Spatie\TwitterStreamingApi\UserStream userStream()
 *
 * @see \Spatie\LaravelTwitterStreamingApi\TwitterStreamingApi
 */
class TwitterStreamingApiFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-twitter-streaming-api';
    }
}
