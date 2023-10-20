<?php

namespace App\Http\Filters;

use App\Helpers\QueryFilter;

class ProductFilter extends QueryFilter {
    public function price($price) {
        return $this->builder->where('price', $price);
    }

    public function greaterPrice($price) {
        return $this->builder->where('price', '>=', $price);
    }
}