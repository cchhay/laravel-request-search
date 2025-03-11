<?php

namespace Cchhay\LaravelRequestSearch\Facades;

use Illuminate\Support\Facades\Facade;

class RequestSerch extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'RequestSearch';
    }
}
