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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//=============== User routes ==================//
Route::post('/register', 'User\RegisterController@register');
Route::post('/oauth/token', 'User\RegisterController@issueToken');

Route::apiResources([

	'products' => 'API\ProductController',
	'products/{product}/reviews' => 'API\ReviewController',
	'brands' => 'API\BrandController',
	'categories' =>'API\CategoryController',
	

]);

/*
Route::apiResource('products', 'API\ProductController');
Route::group(['prefix' => 'products'], function() {

	Route::apiResource('/{product}/reviews', 'API\ReviewController');

});*/