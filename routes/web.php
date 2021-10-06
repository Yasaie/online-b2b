<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
//    $user = \App\User::find(2);
//    dd($user->company);
    foreach (\Route::getRoutes() as $route) {
        $name = $route->getName();
        if (preg_match('/^v1\..+\.(\w+)$/', $name, $match)) {
            $routes[$match[1]][] = $match[0];
        }
    }
    dd($routes);
    return view('welcome');
});
