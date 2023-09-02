<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductListResource;
use App\Http\Resources\ProductResource;
use App\Models\Api\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = request('per_page', 10);
        $search = request('search', '');
        $sortField = request('sort_field', 'created_at');
        $sortDirection = request('sort_direction', 'desc');

        $query = Product::query()
            ->where('title', 'like', "%{$search}%")
            ->orderBy($sortField, $sortDirection)
            ->paginate($perPage);

        return ProductListResource::collection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;

        /** @var \Illuminate\Http\UploadedFile $image */
        $images = $data['images'] ?? [];

        $product = Product::create($data);
        $this->saveImages($images, $product);

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product      $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['updated_by'] = $request->user()->id;

        /** @var \Illuminate\Http\UploadedFile[] $images */
        $images = $data['images'] ?? [];
        $deletedImages = $data['deleted_images'] ?? [];

        // Check if image was given and save on local file system
        $this->saveImages($images, $product);
        $this->deleteImages($deletedImages, $product);

        $product->update($data);

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->noContent();
    }


    private function saveImages($images, Product $product)
    {
        foreach ($images as $i => $image) {
            $path = 'images/' . Str::random();
            if (!Storage::exists($path)) {
                Storage::makeDirectory($path);
            }
            if (!Storage::putFileAS('public/' . $path, $image, $image->getClientOriginalName())) {
                throw new \Exception("Unable to save file \"{$image->getClientOriginalName()}\"");
            }

            $relativePath = $path . '/' . $image->getClientOriginalName();

            ProductImage::create([
                'product_id' => $product->id,
                'path' => $relativePath,
                'url' => URL::to(Storage::url($relativePath)),
                'mime' => $image->getClientMimeType(),
                'size' => $image->getSize(),
                'position' => $i + 1
            ]);
        }
    }

    public function deleteImages($imageIds, Product $product)
    {
        $images = ProductImage::query()
            ->where('product_id', $product->id)
            ->whereIn('id', $imageIds)
            ->get();

        foreach ($images as $image) {
            if ($image->path) {
                Storage::deleteDirectory('/public/' . dirname($image->path));
            }
            $image->delete();
        }
    }
}
