<?php

namespace Cchhay\LaravelRequestSearch\Operations;

class Strategy
{
    protected $searching;
    /**
     * Strategy search constructor which create searhing base on it's operator {$search} strategy
     *
     * @param [array] $collection: all data from model
     * @param [Condition] $condition: request search params {operator,feild,value,conjunction}
     */
    public function __construct($model, Condition $condition, $whereRaw = false)
    {
        $filterClass = strtolower($condition->operator);
        $this->searching = new $condition->supportOperators[$filterClass]($model, $condition, $whereRaw);
    }

    public function search()
    {
        return $this->searching->search();
    }
}
