<?php

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

//register
$router->post('/register', 'AuthController@register');
$router->get('/register', 'AuthController@view');
$router->get('/register/view/{id}', 'AuthController@show');

//login
$router->post('/login', 'AuthController@login');
$router->delete('/delete/{id}', 'AuthController@destroy');

//kategori
$router->post('/kategori', 'kategoryController@create');
$router->get('/kategori/view', 'kategoryController@view');
$router->get('/kategori/show/{id}', 'kategoryController@show');
$router->delete('/kategori/{id}', 'kategoryController@destroy');
$router->put('kategori/{id}', 'kategoryController@update');


//berita
$router->get('/berita', 'BeritaController@cobaJoin');
$router->get('/berita/{id}', 'BeritaController@get');
$router->get('/berita/show/{id}', 'BeritaController@getKategory');
$router->post('/berita', 'BeritaController@tambahBerita');
$router->delete('/berita/{id}', 'BeritaController@destroy');
$router->put('berita/{id}', 'BeritaController@update');

// $router->get('/berita/test', 'BeritaController@cobaJoin2');

//edit user
$router->put('/user/{id}', 'AuthController@editUser');
$router->put('/user/account/{id}', 'AuthController@editAccount');

//komentar user
$router->get('/komentar', 'KomentarController@index');
$router->get('/komentar/{id}', 'KomentarController@getId');
$router->post('/komentar', 'KomentarController@create');



