<?php

namespace Laraflow\TripleA\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Laraflow\TripleA\TripleA
 */
class TripleA extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'triplea';
    }
}
