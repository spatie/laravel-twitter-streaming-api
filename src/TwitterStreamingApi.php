<?php

namespace Spatie\LaravelTwitterStreamingApi;

use Illuminate\Contracts\Config\Repository;
use Spatie\TwitterStreamingApi\PublicStream;
use Spatie\TwitterStreamingApi\UserStream;

class TwitterStreamingApi
{
    /** @var array */
    protected array $config;

    public function __construct(Repository $config)
    {
        $this->config = $config['laravel-twitter-streaming-api'];
    }

    public function publicStream(): PublicStream
    {
        return new PublicStream(
            $this->config['bearer_token'],
            $this->config['api_key'],
            $this->config['api_secret_key']
        );
    }

    public function userStream(): UserStream
    {
        return new UserStream(
            $this->config['handle'],
            $this->config['bearer_token'],
            $this->config['api_key'],
            $this->config['api_secret_key']
        );
    }
}
