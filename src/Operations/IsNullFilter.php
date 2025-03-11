<?php

namespace Cchhay\LaravelRequestSearch\Operations;


class IsNullFilter extends FilterAbstract
{
    public function __construct($model, Condition $condition, $whereRaw)
    {
        parent::__construct($model, $condition, $whereRaw);
    }

    public function getAndSearch()
    {
        return $this->model->whereNull($this->column);
    }

    public function getOrSearch()
    {
        return $this->model->orWhereNull($this->column);
    }
}
