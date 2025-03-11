<?php

namespace Cchhay\LaravelRequestSearch\Operations;


class BetweenFilter extends FilterAbstract
{
    use CheckValueService;

    public function __construct($model, Condition $condition, $whereRaw)
    {
        parent::__construct($model, $condition, $whereRaw);
    }

    public function validCondition()
    {
        # individual condition validate
        if (count($this->condition->value) != 2) {
            throw400('error_condition_value_must_be_array_two_values');
        }
    }

    public function getAndSearch()
    {
        if ($this->isNullOrEmpty($this->condition->value[0])) {
            return $this->model;
        }
        return $this->model->whereBetween($this->column, $this->condition->value);
    }

    public function getOrSearch()
    {
        if ($this->isNullOrEmpty($this->condition->value[0])) {
            return $this->model;
        }
        return $this->model->orWhereBetween($this->column, $this->condition->value);
    }
}
