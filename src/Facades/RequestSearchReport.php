<?php

namespace Cchhay\LaravelRequestSearch;

use Illuminate\Support\Facades\Facade;

class RequestSerchReport extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'RequestSearchReport';
    }
}
