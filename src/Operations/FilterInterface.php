<?php

namespace Cchhay\LaravelRequestSearch\Operations;

interface FilterInterface
{
    public function __construct($model, Condition $condition, $whereRaw);
    public function search();
    public function getOrSearch();
    public function getAndSearch();
    public function validCondition();
}
