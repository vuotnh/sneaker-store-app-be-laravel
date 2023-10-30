<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\ProductImage;

class ProductObserver
{
    /**
     * Hook into product deleting event
     * @param Product $product
     * @return void
     */
    public function deleting(Product $product) {
        ProductImage::where('product_id', $product['id'])->delete();
    }
}
