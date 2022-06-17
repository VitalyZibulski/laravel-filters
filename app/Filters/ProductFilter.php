<?php

namespace App\Filters;

class ProductFilter extends QueryFilter
{
    public function categoryId($id = null)
    {
        return $this->builder->when($id, function($query) use($id) {
            $query->where('category_id', $id);
        });
    }

    public function searchField($param = '')
    {
        return $this->builder
                    ->where('title', 'LIKE', '%' . $param . '%')
                    ->orWhere('description', 'LIKE', '%' . $param . '%');
    }
}
