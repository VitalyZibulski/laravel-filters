<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class BaseFilter
{
    protected $label;
    protected $field;
    protected $values = [];
    protected $multiple = false;

    protected static $view = 'input';
    protected static $type = 'text';

    public function __construct(string $label, string $field, array $values)
    {
        $this->setLabel($label);
        $this->setField($field);
        $this->setValues($values);
    }

    public function make(...$arguments)
    {
        return new static(...$arguments);
    }

    public function label()
    {
        return $this->label;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function field()
    {
        return $this->field;
    }

    public function setField($field)
    {
        $this->field = $field;

        return $this;
    }

    public function values()
    {
        return collect($this->values);
    }

    public function setValues(array $values)
    {
        $this->values = $values;

        return $this;
    }

    public function name()
    {
        return "filters[{$this->field()}]";
    }

    public function id(string $value = null)
    {
        return (string)$this->field()
                ->snake()
                ->prepand('filters_');
    }

    public function isMultiple(): bool
    {
        return $this->multiple;
    }

    public function multiple()
    {
        $this->multiple = true;

        return $this;
    }

    public static function view(): string
    {
        return static::$view;
    }

    public static function setView(string $view): void
    {
        self::$view = $view;
    }

    public static function type(): string
    {
        return static::$type;
    }

    public static function setType(string $type): void
    {
        self::$type = $type;
    }

    public function render()
    {
        return view('filters.' . $this->view(), ['filter' => $this]);
    }

    public function apply(Builder $query)
    {
        if(is_null($this->requestValue())){
            return $query;
        }

        if(is_array($this->requestValue())) {
            $query = $query->whereIn($this->field(), $this->requestValue());
        } else {
            $query = $query->where($this->field(),'=', $this->requestValue());
        }

        return $query;
    }

    public function requestValue()
    {
        $pathDot = (string) Str::of('')->append("{$this->field()}");

        return request($pathDot);
    }
}
