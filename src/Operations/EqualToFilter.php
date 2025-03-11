<?php

namespace Cchhay\LaravelRequestSearch\Operations;

class EqualToFilter extends FilterAbstract
{
    use CheckValueService;

    public function __construct($model, Condition $condition, $whereRaw)
    {
        parent::__construct($model, $condition, $whereRaw);
    }

    public function validCondition()
    {
        if (count($this->condition->value) != 1) {
            throw400('error_condition_value_must_be_array_one_value');
        }
    }

    public function getAndSearch()
    {
        $value = $this->condition->value[0];
        if ($this->isNullOrEmpty($value)) {
            return $this->model;
        }
        return $this->model->where($this->column, $value);
    }

    public function getOrSearch()
    {
        $value = $this->condition->value[0];
        if ($this->isNullOrEmpty($value)) {
            return $this->model;
        }
        return $this->model->orWhere($this->column, $value);
    }
}
