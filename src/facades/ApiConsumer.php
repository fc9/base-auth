<?php

namespace Fc9\Auth\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Fc9\Auth\Skeleton\SkeletonClass
 */
class ApiConsumer extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'apiconsumer';
    }

}
