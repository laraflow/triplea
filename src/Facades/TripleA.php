<?php

namespace Laraflow\TripleA\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Laraflow\TripleA\TripleA
 */
class TripleA extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'TripleA';
    }
}
