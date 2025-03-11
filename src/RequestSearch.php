<?php

namespace Cchhay\LaravelRequestSearch;

use Cchhay\LaravelRequestSearch\Traits\RequestSearch as TraitsRequestSearch;

class RequestSearch
{
    use TraitsRequestSearch;
    /**
     * Request query, search, filter, sort and paging
     *
     * @param [type] $model
     * @param array $whereColumns - map the columns for filtering, searching and sorting conditions
     *      [
     *          'name' => 'employee.name',
     *          'fullname' => DB::raw('concat(`employee`.`firstname`, `employee`.`lastname`)'), # raw
     *          'year' => DB::raw('year(`employee`.`birthdate`)') # raw
     *      ]
     * @return void
     */
    public function getSearch($model, $whereColumns = [], $defaultSorts = [])
    {
        return $this->search($model, $whereColumns, $defaultSorts);
    }

    public function getSearchReport($model, $wheres = [], $defaultSorts = [])
    {
        return $this->searchReport($model, $wheres, $defaultSorts);
    }
}
