<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
$router->group(['prefix' => 'api/user'], function () use ($router) {
    $router->get('companies',  ['uses' => 'CompaniesController@getUserCompanies']);

    $router->post('companies',  ['uses' => 'CompaniesController@postUserCompanies']);

    $router->post('sign-in', ['uses' => 'AuthController@authenticate']);

    $router->post('register', ['uses' => 'AuthController@register']);

    $router->post('recover-password', ['uses' => 'AuthController@recoverPassword']);

    $router->put('authors/{id}', ['uses' => 'AuthorController@update']);
});
