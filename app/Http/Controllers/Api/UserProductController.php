<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Product as ProductResource;
use App\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserProductController extends ProductController
{
    /**
     * @author  Payam Yasaie <payam@yasaie.ir>
     * @since   2019-11-09
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $size = $request->size ?: $this->page_size;

        /** @var Product $product */
        $product = $this->all($request);
        $product = $product->where('created_by', \Auth::id());

        return ProductResource::collection($product->paginate($size));
    }

    public function show(Request $request, $id)
    {
        /** @var Builder $product */
        if (\Auth::user()->canUpdate($request->route())) {
            $product = Product::withInvisible();
        } else {
            $product = Product::select();
        }

        $product = $product->with($this->load)
            ->where('created_by', \Auth::id())
            ->find($id);

        return new ProductResource($product);
    }

    public function update(Request $request, $id)
    {
        try {
            /** @var Product $product */
            $product = Product::where('created_by', \Auth::id())
                ->findOrFail($id);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return $this->updateRequest($request, $product);
    }
}
