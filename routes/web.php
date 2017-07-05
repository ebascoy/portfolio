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
    return view('welcome');
});
Route::get('/api/request-header-parser',
    'Api\RequestHeaderParser\RequestHeaderParserController@index');
Route::get('/short/new', 'Api\ShortUrl\ShortUrlController@create');
Route::get('/short/{short_url}', 'Api\ShortUrl\ShortUrlController@index');
Route::get('/api/image/search', 'Api\ImageSearch\ImageSearchController@index');
Route::get('/api/image/recent', 'Api\ImageSearch\ImageSearchController@recentSearches');
