<?php

namespace App;

class App
{
    protected $filters = [];

    public function registerFilters(array $filters)
    {
        $this->filters = $filters;
    }

    public function filters()
    {
        return $this->filters;
    }
}
