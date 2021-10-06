<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Localization;
use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function index()
    {
        return Localization::collection(collect(config('global.langs'))->values());
    }

    public function show($id)
    {
        return new Localization(config('global.langs.' . $id));
    }
}
