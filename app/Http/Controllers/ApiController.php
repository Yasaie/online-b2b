<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class ApiController extends Controller
{
    protected $model;
    protected $resource;
    protected $load = [];
    protected $page_size = 15;

    protected function getController()
    {
        return str_replace('Controller', '',
            substr(
                strrchr(
                    get_called_class(), "\\"
                ), 1
            )
        );
    }

    protected function getResource()
    {
        $class = $this->resource ?: '\\App\\Http\\Resources\\' . $this->getController();

        return class_exists($class) ? $class : null;
    }

    protected function getModel()
    {
        $class = $this->model ?: '\\App\\' . $this->getController();

        return class_exists($class) ? $class : null;
    }


    public function index(Request $request)
    {
        $size = $request->size ?: $this->page_size;

        $resource = $this->getResource();
        $collection = $resource . 'Collection';
        /** @var \Eloquent $model */
        $model = $this->getModel();
        $object = $model::with($this->load)
            ->paginate($size);

        if (class_exists($collection)) {
            return new $collection($object);
        } else {
            /** @var JsonResource $resource */
            return $resource::collection($object);
        }
    }

    public function show(Request $request, $id)
    {
        /** @var JsonResource $resource */
        $resource = $this->getResource();
        /** @var \Eloquent $model */
        $model = $this->getModel();
        $object = $model::with($this->load)
            ->find($id);

        return new $resource($object);
    }

    public function destroy($id)
    {
        try {
            /** @var \Eloquent $model */
            $model = $this->getModel();
            $object = $model::withoutGlobalScopes()
                ->findOrFail($id);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(['result' => $object->delete()]);
    }

}
