<?php

namespace App\Models;

use App\App;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFiltered(Builder $query)
    {
        foreach (app(App::class)->filters() as $filter) {
            $query = $filter->apply($query);
        }

        return $query;
    }

    public function scopeSorted(Builder $query)
    {
        return $query;
    }
}
