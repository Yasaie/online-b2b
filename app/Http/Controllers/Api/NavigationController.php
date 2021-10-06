<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Navigation as NavigationResource;
use App\Navigation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class NavigationController extends ApiController
{
    protected $load = ['parent', 'children'];

    public function index(Request $request)
    {
        $size = $request->size ?: $this->page_size;

        /** @var Builder $object */
        $object = Navigation::select();

        if ($request->parent !== null) {
            $object->where('parent_id', $request->parent ?: null);
        }

        if ($request->include_children) {
            $object->with(repeatRelation('children', $request->include_children));
        }

        if ($request->include_parent) {
            $object->with('parent');
        }

        return NavigationResource::collection($object->paginate($size));
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        $navigation = Navigation::create($request->all());
        $navigation->createLocale('title', $request->title);

        return new NavigationResource($navigation);
    }

    public function update(Request $request, $id)
    {
        if ($navigation = Navigation::find($id)) {
            $this->validateRequest($request);

            $navigation->update($request->all());
            $navigation->updateLocale('title', $request->title);

            return new NavigationResource($navigation);
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
            'parent_id' => ['exists:navigations,id'],
            'link' => ['required', 'string', 'between:3,200']
        ]);
    }
}
