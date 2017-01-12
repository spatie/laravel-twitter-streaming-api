<?php

namespace Spatie\LaravelTwitterStreamingApi;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Spatie\LaravelTwitterStreamingApi\LaravelTwitterStreamingApiClass
 */
class SkeletonFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'skeleton';
    }
}
