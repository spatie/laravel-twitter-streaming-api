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
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-twitter-streaming-api';
    }
}
