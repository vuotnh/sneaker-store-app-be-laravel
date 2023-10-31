<?php

namespace App\Http\Controllers;

use App\Http\Filters\ProductFilter;
use App\Http\Requests\CreateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\File as SavedFile;
use App\Models\Product;
use App\Models\ProductImage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list(ProductFilter $filters)
    {
        // $productList = Product::with('category', 'images', 'images.image')->get();
        // $product = (new Product)->newQuery(); // tạo instance của eloquent builder
        $productv2 = Product::filter($filters)->with('category', 'images', 'images.image')->get();
        return new ProductCollection($productv2);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        $data_validated = $request->validated();
        $uploadedNewFile = $data_validated['uploadedNewFile'];
        $removeFileList = $data_validated['removeFileList'];
        unset($data_validated['uploadedNewFile']);
        unset($data_validated['removeFileList']);
        // if ($request->hasFile('imageFile')) {
        $newProduct = Product::create($data_validated);
        $listNewProductFile = [];
        foreach ( $uploadedNewFile as $newFileId) {
            array_push($listNewProductFile, [
                'product_id' => $newProduct['id'],
                'file_id' => $newFileId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        
        ProductImage::insert($listNewProductFile);

        if (count($removeFileList)) {
            ProductImage::where(['product_id', '', $newProduct['id']])->whereIn('file_id', $removeFileList)->delete();
        }
        
        return response()->json($newProduct);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::where('id', $id)->with('category', 'images', 'images.image')->first();
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateProductRequest $request, Product $product)
    {
        $data_validated = $request->validated();
        $uploadedNewFile = $data_validated['uploadedNewFile'];
        $removeFileList = $data_validated['removeFileList'];
        unset($data_validated['uploadedNewFile']);
        unset($data_validated['removeFileList']);

        if (count($uploadedNewFile)) {
            $listNewProductFile = [];
            foreach ( $uploadedNewFile as $newFileId) {
                array_push($listNewProductFile, [
                    'product_id' => $product['id'],
                    'file_id' => $newFileId,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
            ProductImage::insert($listNewProductFile);
        }

        if (count($removeFileList)) {
            ProductImage::whereIn('file_id', $removeFileList)->where([['product_id', $product['id']]])->delete();
        }
        Product::where('id', $product['id'])->update($data_validated);
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        $productImage = ProductImage::where('product_id', $product['id'])->get();
        return response()->noContent();
    }
}
