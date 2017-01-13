<?php

namespace Spatie\LaravelTwitterStreamingApi\Test;

use TwitterStreamingApi;
use Spatie\TwitterStreamingApi\UserStream;
use Spatie\TwitterStreamingApi\PublicStream;

class FacadeTest extends TestCase
{
    /** @test */
    public function it_can_return_a_public_stream()
    {
        $this->assertInstanceOf(PublicStream::class, TwitterStreamingApi::publicStream());
    }

    /** @test */
    public function it_can_return_a_user_stream()
    {
        $this->assertInstanceOf(UserStream::class, TwitterStreamingApi::userStream());
    }
}
