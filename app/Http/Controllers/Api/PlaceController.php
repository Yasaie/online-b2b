<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Place as PlaceResource;
use App\Place;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PlaceController extends ApiController
{
    public function index(Request $request)
    {
        $size = $request->size ?: $this->page_size;

        /** @var Builder $place */
        if (
            \Auth::user()->canUpdate($request->route())
            and $request->is_visible
        ) {
            $place = Place::withInvisible();
        } else {
            $place = Place::select();
        }

        if ($request->include_parent !== "0") {
            $place->with('parent');
        }

        if ($request->include_children) {
            $place->with('children');
        }

        if ($request->type) {
            $place->where('type', $request->type);
        }

        if ($request->search) {
            $place->where('name', $request->search);
        }

        return PlaceResource::collection($place->paginate($size));
    }

    public function show(Request $request, $id)
    {
        /** @var Builder $place */
        if (\Auth::user()->canUpdate($request->route())) {
            $place = Place::withInvisible();
        } else {
            $place = Place::select();
        }

        if ($request->include_parent !== "0") {
            $place->with('parent');
        }

        if ($request->include_children) {
            $place->with('children');
        }

        return new PlaceResource($place->find($id));
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        return new PlaceResource(Place::create($request->all()));
    }

    public function update(Request $request, $id)
    {
        if ($place = Place::find($id)) {
            $this->validateRequest($request);

            $place->update($request->all());
            $place->touch();

            return new PlaceResource($place);
        }

        return response()->json(['message' => 'Not found'], 404);
    }

    /**
     * @author  Payam Yasaie <payam@yasaie.ir>
     * @since   2019-11-12
     *
     * @param Request $request
     *
     * @throws ValidationException
     */
    protected function validateRequest(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'between:3,200'],
            'type' => ['required', Rule::in(config('global.place_types'))],
            'parent_id' => ['exists:places,id']
        ]);
    }

}
