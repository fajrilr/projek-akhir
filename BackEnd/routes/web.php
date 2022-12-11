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

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/register', ['uses'=> 'AuthController@register']);
    $router->post('/login', ['uses'=> 'AuthController@login']);
});

$router->group(['prefix' => 'mahasiswa'], function () use ($router) {
    $router->get('/', ['uses'=> 'MahasiswaController@getAllMhs']);
    $router->get('/profile', ['middleware' => 'jwt.auth', 'uses'=> 'MahasiswaController@getMhsToken']);
    $router->get('/{nim}', ['uses' => 'MahasiswaController@getMahasiswaById']);
    $router->post('/{nim}/mk/{mkId}', ['uses' => 'MahasiswaController@addMk']); 
});

$router->group(['prefix' => 'matakuliah'], function () use ($router) {
    $router->post('/create', ['uses' => 'MatakuliahController@createMk']);
    $router->get('/', ['uses' =>'MatakuliahController@getAllMk']);
});

// $router->get('/mahasiswa/profile', ['middleware' => 'jwt.auth', 'uses' => 'MahasiswaController@getMhsToken']);


// $router->get('/', ['uses' => 'HomeController@index']);
// $router->get('/hello', ['uses' => 'HomeController@hello']);

// $router->get('/register', ['uses' => 'HomeController@register']);
// $router->get('/login', ['uses' => 'HomeController@login']);
