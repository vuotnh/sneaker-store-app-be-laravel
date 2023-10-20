<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 
        'file_id',
    ];

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function image(): HasOne {
        return $this->hasOne(File::class, 'id', 'file_id');
    }
}
