<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Category as CategoryResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends ApiController
{
    protected $load = ['parent'];

    public function index(Request $request)
    {
        $size = $request->size ?: $this->page_size;

        /** @var Builder $object */
        if (
//            \Auth::user()->canUpdate($request->route()) and
            $request->is_visible
        ) {
            $object = Category::withInvisible();
        } else {
            $object = Category::select();
        }

        $object = joinDictionary($object, Category::class);

        if ($request->path) {
            $object->whereRaw('categories.path regexp CONCAT("(^|\/)", ?, "($|\/)")', $request->path);
        }

        if ($request->parent !== null) {
            $object->where('parent_id', $request->parent ?: null);
        }

        if ($request->include_parent !== "0") {
            $object->with('parent');
        }

        if ($request->include_children) {
            $object->with(repeatRelation('children', $request->include_children));
        }

        if ($request->search) {
            $object->whereRaw('title LIKE CONCAT("%", ?, "%")', $request->search);
        }

        return CategoryResource::collection($object->paginate($size));
    }

    public function show(Request $request, $id)
    {
        /** @var Builder $object */
        if (\Auth::user()->canUpdate($request->route())) {
            $object = Category::withInvisible();
        } else {
            $object = Category::select();
        }
        $object = Category::withInvisible();


        // TODO: hidden path should fix
        $object = $object->with($this->load)
            ->find($id);

        return new CategoryResource($object);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        $category = Category::create($request->all());

        $category->createLocale('title', $request->title);

        return new CategoryResource($category);
    }

    public function update(Request $request, $id)
    {
        if ($category = Category::find($id)) {
            $this->validateRequest($request);

            $category->update($request->all());
            $category->updateLocale('title', $request->title);
            $category->touch();

            return new CategoryResource($category);
        }

        return response()->json(['message' => 'Not found'], 404);
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
            'title.' . config('app.fallback_locale') => ['required', 'string', 'between:3,200'],
            'parent_id' => ['nullable', 'exists:categories,id'],
            'is_visible' => ['boolean']
        ]);
    }

}
