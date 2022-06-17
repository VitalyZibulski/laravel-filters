<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class SearchFilter extends BaseFilter
{
    protected static $view = 'search';

    public function apply(Builder $query)
    {
        if(is_null($this->requestValue())){
            return $query;
        }

        return $query->where('title','LIKE', '%'. $this->requestValue() . '%');
    }
}
