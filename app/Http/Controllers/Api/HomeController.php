<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function index()
    {
        $routes = [];
        /** @var \Illuminate\Routing\Route $route */
        foreach (Route::getRoutes()->getIterator() as $route) {
            if (strpos($route->uri, 'v1') !== false) {
                $routes[] = [
                    'url' => url($route->uri),
                    'methods' => implode('|', $route->methods),
                ];
            }
        }
        return $routes;
    }
}
