<?php

namespace App\Observers;

use App\Models\ProductImage;

class ProductImageObserver
{
    /**
     * Hook into productImage deleting event
     * @param ProductImage $productImage
     * @return void
     */
    public function deleting(ProductImage $productImage) {
        $productImage->image()->delete();
    }
}
