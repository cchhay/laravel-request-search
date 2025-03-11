<?php

namespace Cchhay\LaravelRequestSearch\Operations;


class IsNotNullFilter extends FilterAbstract
{
    public function __construct($model, Condition $condition, $whereRaw)
    {
        parent::__construct($model, $condition, $whereRaw);
    }

    public function getAndSearch()
    {
        return $this->model->whereNotNull($this->column);
    }

    public function getOrSearch()
    {
        return $this->model->orWhereNotNull($this->column);
    }
}
