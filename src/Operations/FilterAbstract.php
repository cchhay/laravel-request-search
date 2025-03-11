<?php

namespace Cchhay\LaravelRequestSearch\Operations;

abstract class FilterAbstract implements FilterInterface
{
    protected $model;
    protected Condition $condition;
    protected $column;
    protected $whereRaw;

    public function __construct($model, Condition $condition, $whereRaw = false)
    {
        $this->whereRaw = $whereRaw;
        $this->condition = $condition;
        $this->model = $model;
        $this->column = $this->condition->column;
        $this->validCondition();
    }

    public function validCondition() {}

    public function search()
    {
        /**
         * Bypass when value are empty array
         */
        if (!count($this->condition->value)) {
            return $this->model;
        }

        /**
         * Bypass when value are empty string ( '' ) or null
         */
        if (!is_array($this->condition->value)) {
            if ($this->condition->value === '' || $this->condition->value === null) {
                return $this->model;
            }
        }

        /**
         * Apply search with OR conjunction
         */
        if ($this->condition->conjunction == 'or') {
            return $this->model = $this->getOrSearch();
        }
        /**
         * Apply search with AND conjunction
         */
        if ($this->condition->conjunction == 'and') {
            return $this->model =  $this->getAndSearch();
        }

        /**
         * other case bypass
         */
        return $this->model;
    }
}
