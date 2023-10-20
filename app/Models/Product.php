<?php

namespace App\Models;

use App\Helpers\QueryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'discountRate',
        'category_id'
    ];

    public function category(): HasOne {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function images(): HasMany {
        return $this->hasMany(ProductImage::class, 'product_id', null);
    }

    /**
     * Tham khảo tạo scope filter trong model eloquent
     *  https://viblo.asia/p/cach-query-filter-don-gian-hon-trong-laravel-naQZRykvKvx
     *  https://viblo.asia/p/laravel-eloquent-technique-dedicated-query-string-filtering-oZVRg4XZMmg5
     */
    public function scopeFilter($query, QueryFilter $filters) {
        return $filters->apply($query);
    }
}
