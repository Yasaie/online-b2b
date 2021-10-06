<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Product as ProductResource;
use App\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductController extends ApiController
{
    protected $load = ['category', 'place.parent'];


    protected function all(Request $request)
    {
        $sort = $request->sort ?: 'id';
        $dir = $request->dir ?: 'asc';

        /** @var Builder $product */
        if (
            \Auth::user()->canUpdate($request->route())
            and $request->is_visible
        ) {
            $product = Product::withInvisible();
        } else {
            $product = Product::select();
        }

        $product = joinDictionary($product, Product::class);

        if ($request->random) {
            $product->inRandomOrder();
        } else {
            $product->orderBy($sort, $dir);
        }

        $product->with(['category', 'place']);

        if ($request->is_special !== null) {
            $product->where('is_special', $request->is_special);
        }

        if ($request->category) {
            $product->where('category_id', $request->category);
        }

        if ($request->search) {
            $product->whereRaw('CONCAT(title, " ", description) LIKE CONCAT("%", ?, "%")', $request->search);
        }

        if ($request->place) {
            $product->where('place_id', $request->place);
        }

        $product->inRandomOrder();

        return $product;
    }

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
            ->find($id);

        return new ProductResource($product);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        $product = Product::create($request->all());
        $product->createLocale('title', $request->title);
        $product->createLocale('description', $request->description);

        uploadMedia($product, $request->images, 'image');

        return new ProductResource($product);
    }

    protected function updateRequest(Request $request, Product $product)
    {
        $this->validateRequest($request);

        $product->update($request->all());
        $product->updateLocale('title', $request->title);
        $product->updateLocale('description', $request->description);
        $product->touch();

        uploadMedia($product, $request->images, 'image');

        return new ProductResource($product);
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return $this->updateRequest($request, $product);
    }

    /**
     * @author  Payam Yasaie <payam@yasaie.ir>
     * @since   2019-11-13
     *
     * @param Request $request
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateRequest(Request $request)
    {
        $this->validate($request, [
            'place_id' => ['exists:places,id'],
            'category_id' => ['exists:categories,id'],
            'title.' . config('app.fallback_locale') => ['required', 'string', 'between:3,200'],
            'description.' . config('app.fallback_locale') => ['required', 'string', 'min:3'],
            'is_visible' => ['boolean'],
            'is_special' => ['boolean'],
        ]);
    }

}
