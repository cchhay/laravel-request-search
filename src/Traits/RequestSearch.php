<?php

namespace Cchhay\LaravelRequestSearch\Traits;

use Cchhay\LaravelRequestSearch\Operations\Condition;
use Cchhay\LaravelRequestSearch\Operations\Strategy;

trait RequestSearch
{
    /**
     * Request query, search, filter, sort and paging
     *
     * @param [type] $model
     * @param array $wheres - map the columns for filtering, searching and sorting conditions
     *      [
     *          'name' => 'employee.name',
     *          'fullname' => DB::raw('concat(`employee`.`firstname`, `employee`.`lastname`)'), # raw
     *          'year' => DB::raw('year(`employee`.`birthdate`)') # raw
     *      ]
     * @return void
     */
    public function search($model, $wheres = [], $defaultSorts = [])
    {
        $model = $this->filtering($model, $wheres);
        $model = $this->searching($model, $wheres);
        $model = $this->sorting($model, $wheres);
        # apply default sorts if there no request sorts
        $model = $this->defaultSort($model, $wheres, $defaultSorts);

        if (req('params.paging')) {
            return $model->paginate(req('params.pagesize') ?: DEFAULT_PAGE_SIZE);
        }

        return  $model->get();
    }

    public function searchReport($model, $wheres, $defaultSorts = [])
    {
        $model = $this->searching($model, $wheres);
        $model = $this->sorting($model, $wheres);
        # apply default sorts if there no request sorts
        $model = $this->defaultSort($model, $wheres, $defaultSorts);

        return $model->get();
    }

    private function filtering($model, $wheres = [])
    {
        # Filtering
        $filterText = req('params.filter');

        if (!$filterText) {
            return $model;
        }

        if (count($wheres)) {
            $model->where(function ($query) use ($wheres, $filterText) {
                $keys = array_keys($wheres);
                for ($i = 0; $i < count($keys); $i++) {
                    $column = $wheres[$keys[$i]];
                    if ($i == 0) {
                        $query->where($column, 'like', "%{$filterText}%");
                        continue;
                    }
                    $query->orWhere($column, 'like', "%{$filterText}%");
                }
            });
        }

        return $model;
    }

    // TODO: search conditions -- condition and condition and (condition or condition) and (condition and condition)
    private function searching($model, $wheres = [])
    {
        # Searching
        $searches = req('params.search') ?: [];

        # search normal and join field
        foreach ($searches as $condition) {
            if (!$wheres[$condition['column']]) {
                throw400('err_search_column_not_in_model_field');
            }
            $condition['column'] = $wheres[$condition['column']];
            $strategy = new Strategy($model, new Condition($condition));
            $model = $strategy->search();
        }

        return $model;
    }

    private function sorting($model, $wheres = [])
    {
        # Sorting
        $sorts = req('params.sorts') ?: [];

        # case null or empty sorts
        if (!$sorts || count($sorts) <= 0) {
            return $model;
        }

        # loop throw sorts and apply sort base on arrays of where's columns
        foreach ($sorts as $sort) {
            $sortColumn = $sort['column'];
            $sortDirection = $sort['direction'] ? $sort['direction'] : 'asc';
            $model->orderBy($wheres[$sortColumn], $sortDirection);
        }

        return $model;
    }

    private function defaultSort($model, $wheres = [], $sortDefaults = [])
    {
        # case no default sort config
        if (count($sortDefaults) <= 0) {
            return $model;
        }

        # case has request sort
        if (count(req('params.sorts')) > 0) {
            return $model;
        }

        #
        foreach ($sortDefaults as $column => $direction) {
            $column = isset($wheres[$column]) ? $wheres[$column] : $column;
            $model->orderBy($column, $direction);
        }

        return $model;
    }
}
