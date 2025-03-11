<?php

namespace Cchhay\LaravelRequestSearch\Operations;

class Condition
{
    public $operator;
    public $column;
    public $value;
    public $conjunction;
    public $supportOperators = [
        'notequalto' => NotEqualToFilter::class,
        'equalto' => EqualToFilter::class,
        'beginwith' => BeginWithFilter::class,
        'startwith' => BeginWithFilter::class,
        'endwith' => EndWithFilter::class,
        'between' => BetweenFilter::class,
        'contain' => ContainFilter::class,
        'greaterthan' => GreaterThanFilter::class,
        'greaterthanorequalto' => GreaterThanOrEqualToFilter::class,
        'lessthan' => LessThanFilter::class,
        'lessthanorequalto' => LessThanOrEqualToFilter::class,
        'isEmpty' => IsEmptyFilter::class,
        'isNotEmpty' => IsNotEmptyFilter::class,
        'isNull' => IsNullFilter::class,
        'isNotNull' => IsNotNullFilter::class
    ];
    protected $supportConjunctions = ['and', 'or'];

    public function __construct($condition)
    {
        # required
        if (!array_key_exists('operator', $condition)) {
            throw400('condition_operator_required');
        }
        if (!array_key_exists('column', $condition)) {
            throw400('condition_column_required');
        }
        if (!array_key_exists('value', $condition)) {
            throw400('condition_value_required');
        }
        if (!array_key_exists('conjunction', $condition)) {
            throw400('condition_conjunction_required');
        }

        # condition's value must be array
        if (!is_array($condition['value'])) {
            throw400('condition_value_must_be_array');
        }

        $this->column = $condition['column'];
        $this->operator = $condition['operator'];
        $this->value = $condition['value'];
        $this->conjunction = $condition['conjunction'];

        if (!in_array(strtolower($this->operator), array_keys($this->supportOperators))) {
            throw400('error_not_support_search_operator', ['value' => $this->operator]);
        }

        if (!in_array(strtolower($this->conjunction), $this->supportConjunctions)) {
            throw400('error_not_support_search_conjunction', ['value' => $this->conjunction]);
        }
    }
}
