<?php

namespace Cchhay\LaravelRequestSearch\Operations;


class ContainFilter extends FilterAbstract
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
        if ($this->isNullOrEmpty($this->condition->value[0])) {
            return $this->model;
        }
        return $this->model->where($this->column, 'like', "%{$this->condition->value[0]}%");
    }

    public function getOrSearch()
    {
        if ($this->isNullOrEmpty($this->condition->value[0])) {
            return $this->model;
        }
        return $this->model->orWhere($this->column, 'like', "%{$this->condition->value[0]}%");
    }
}
