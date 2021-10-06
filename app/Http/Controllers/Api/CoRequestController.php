<?php

namespace App\Http\Controllers\Api;

use App\CoRequest;
use App\Http\Controllers\ApiController;
use App\Http\Resources\CoRequest as CoRequestResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CoRequestController extends ApiController
{
    protected $load = ['user', 'product'];

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $size = $request->size ?: $this->page_size;

        /** @var Builder $object */
        $object = CoRequest::select();

        $object->with($this->load);

        return CoRequestResource::collection($object->paginate($size));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return CoRequestResource
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);

        $co_request = CoRequest::create($request->only('product_id', 'description'));

        return new CoRequestResource($co_request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return CoRequestResource
     */
    public function update(Request $request, $id)
    {
        if ($co_request = CoRequest::find($id)) {
            $this->validateRequest($request);

            $co_request->update($request->only('product_id', 'description'));

            return new CoRequestResource($co_request);
        }

        return response()->json(['message' => 'Not found'], 404);
    }

    function validateRequest(Request $request)
    {
        $this->validate($request, [
            'product_id' => ['required', 'exists:products,id']
        ]);
    }
}
