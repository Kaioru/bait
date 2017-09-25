<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleSlugController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\StarController;
use App\Http\Controllers\UserController;
use Dingo\Api\Routing\Router;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$api = app(Router::class);

$api->version('v1', function ($api) {
    $api->group(['prefix' => 'auth'], function ($api) {
        $api->post('login', AuthenticationController::class . '@authenticate');
        $api->post('register', UserController::class . '@store');
    });

    $api->get('self', UserController::class . '@self');
    $api->resource('users', UserController::class);
    $api->resource('slug/articles', ArticleSlugController::class);
    $api->resource('articles', ArticleController::class);
    $api->resource('stars', StarController::class);
});
