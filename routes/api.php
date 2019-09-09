<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) 
{
    return $request->user();

});

Route::post('/register', 'Api\UserApi@register');
Route::post('/login', 'Api\UserApi@authenticate');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('/user', 'Api\UserApi@getAuthenticatedUser');
    Route::group(array('prefix' => 'aturan'), function()
    {
        Route::post('list', ['as' => 'aturanapi.list', 'uses' => 'Api\AturanApi@list']);
        Route::post('show/{id}', ['as' => 'aturanapi.show', 'uses' => 'Api\AturanApi@show']);
    });
    Route::group(array('prefix' => 'putusan'), function()
    {
        Route::post('list', ['as' => 'putusanapi.list', 'uses' => 'Api\PutusanApi@list']);
        Route::post('show/{id}', ['as' => 'putusanapi.show', 'uses' => 'Api\PutusanApi@show']);
    });
    Route::group(array('prefix' => 'treaty'), function()
    {
        Route::post('list', ['as' => 'treatyapi.list', 'uses' => 'Api\TreatyApi@list']);
        Route::post('show/{id}', ['as' => 'treatyapi.show', 'uses' => 'Api\TreatyApi@show']);
    });
    Route::group(array('prefix' => 'kpp'), function()
    {
        Route::post('list', ['as' => 'kppapi.list', 'uses' => 'Api\KppApi@list']);
        Route::post('show/{id}', ['as' => 'kppapi.show', 'uses' => 'Api\KppApi@show']);
    });
    Route::post('trending/list/{id}', ['as' => 'trendingapi.list', 'uses' => 'Api\TrendingApi@list']);
    Route::post('tag/list/{id}', ['as' => 'tagapi.list', 'uses' => 'Api\TagApi@list']);
    Route::post('highlight/list', ['as' => 'highlightapi.list', 'uses' => 'Api\HighlightApi@list']);
    Route::post('{param}/list', ['as' => 'contentapi.list', 'uses' => 'Api\ContentApi@list']);
    Route::post('{param}/show/{site}', ['as' => 'contentapi.show', 'uses' => 'Api\ContentApi@show']);
});