<?php

namespace Spatie\LaravelTwitterStreamingApi;

use Spatie\TwitterStreamingApi\UserStream;
use Illuminate\Contracts\Config\Repository;
use Spatie\TwitterStreamingApi\PublicStream;

class TwitterStreamingApi
{
    /** @var array */
    protected $config;

    public function __construct(Repository $config)
    {
        $this->config = $config['laravel-twitter-streaming-api'];
    }

    public function publicStream(): PublicStream
    {
        return new PublicStream(
            $this->config['access_token'],
            $this->config['access_token_secret'],
            $this->config['consumer_key'],
            $this->config['consumer_secret']
        );
    }

    public function userStream(): UserStream
    {
        return new UserStream(
            $this->config['access_token'],
            $this->config['access_token_secret'],
            $this->config['consumer_key'],
            $this->config['consumer_secret']
        );
    }
}
