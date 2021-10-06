<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\{CategoryController,
    CoRequestController,
    HomeController,
    MediaController,
    NavigationController,
    PlaceController,
    ProductController,
    LocalizationController,
    SettingController,
    UserController,
    UserProductController};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')
    ->name('v1.')
    ->group(function () {

        Route::post('/login', [LoginController::class, 'login'])
            ->name('auth.login');

        Route::get('/', [HomeController::class, 'index'])
            ->name('home.index');

        Route::post('/logout', [LoginController::class, 'logout'])
            ->name('auth.logout');

        Route::apiResource('/locales', LocalizationController::class)
            ->only(['index', 'show']);
        Route::apiResource('/categories', CategoryController::class);
        Route::apiResource('/products', ProductController::class);
        Route::apiResource('/user_products', UserProductController::class)
            ->except('store');
        Route::apiResource('/places', PlaceController::class);
        Route::apiResource('/navigations', NavigationController::class);
        Route::apiResource('/co_request', CoRequestController::class);
        Route::apiResource('/users', UserController::class);

        Route::prefix('/settings/{key?}')
            ->name('settings.')
            ->group(function () {
                Route::get('/', [SettingController::class, 'index'])
                    ->where('key', '([A-Za-z0-9\/])*')
                    ->name('index');
                Route::match(['put', 'patch'], '/', [SettingController::class, 'update'])
                    ->where('key', '([A-Za-z0-9\/])*')
                    ->name('update');
            });

        Route::apiResource('/media', MediaController::class)
            ->only(['store', 'destroy']);
    });


