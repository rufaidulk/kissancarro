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
Route::post('/verify', 'User\RegisterController@verify');
Route::post('/login', 'User\LoginController@login');
Route::post('/resetotp', 'User\ForgotPasswordController@sendResetOTP');
Route::post('/verifyotp', 'User\ForgotPasswordController@verify');


Route::apiResources([

	'products' => 'API\ProductController',
	'products/{product}/reviews' => 'API\ReviewController',
	'brands' => 'API\BrandController',
	'categories' =>'API\CategoryController',
	'guests' => 'API\GuestController',
]);
Route::group(['prefix' => 'guest'], function() {
	Route::apiResource('/{guest}/carts', 'API\CartController');
});
Route::group(['prefix' => 'user', 'middleware' => 'auth:api'], function() {
	Route::apiResource('/{user}/orders', 'API\OrderController');
});
Route::group(['prefix' => 'user', 'middleware' => 'auth:api'], function() {
	Route::apiResource('/{user}/profiles', 'API\ProfileController');
});
/*
Route::apiResource('products', 'API\ProductController');
Route::group(['prefix' => 'products'], function() {

	Route::apiResource('/{product}/reviews', 'API\ReviewController');

});*/