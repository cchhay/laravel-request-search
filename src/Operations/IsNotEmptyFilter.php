<?php

namespace Cchhay\LaravelRequestSearch\Operations;

use Illuminate\Support\Facades\DB;

class IsNotEmptyFilter extends FilterAbstract
{
    public function __construct($model, Condition $condition, $whereRaw)
    {
        parent::__construct($model, $condition, $whereRaw);
    }

    public function getAndSearch()
    {
        return $this->model->where($this->column, '!=', '');
    }

    public function getOrSearch()
    {
        return $this->model->orWhere($this->column, '!=', '');
    }
}
