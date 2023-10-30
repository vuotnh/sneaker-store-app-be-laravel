<?php

namespace App\Http\Controllers;

use App\Http\Filters\ProductFilter;
use App\Http\Requests\CreateProductRequest;
use App\Http\Resources\ProductCollection;
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
        // if ($request->hasFile('imageFile')) {
        $newProduct = Product::create($data_validated);

        $listFile = $request->allFiles('file[]')['file'];

        $listNewProductFile = [];
        foreach ( $listFile as $file) {
            $newFile['name'] = $file->hashName();
            $newFile['originName'] = $file->getClientOriginalName();
            $newFile['fileExt'] = $file->extension();
            $newFile['fileSize'] = $file->getSize();
            $newFile['filePath'] = $file->storeAs('/', $file->hashName(), ['disk' => 'images']);
            $savedFile = SavedFile::create($newFile);

            array_push($listNewProductFile, [
                'product_id' => $newProduct['id'],
                'file_id' => $savedFile['id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        
        ProductImage::insert($listNewProductFile);
        
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
    public function update(Request $request, Product $product)
    {
        //
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
