<?php

namespace Cchhay\LaravelRequestSearch\Operations;


trait CheckValueService
{
    public function isNullOrEmpty($value)
    {
        if ($value === '' || $value === null) {
            return true;
        }

        return false;
    }
}
