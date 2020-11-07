<?php

use App\Http\Middleware\CheckRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

//Posts routers
Route::get('/posts/{id}','PostsController@show');

Route::get('/posts','PostsController@index');

Route::middleware('auth:admin-api')->delete('/posts/{id}','PostsController@destroy');

Route::middleware('auth:admin-api')->post('/posts','PostsController@store');

Route::middleware('auth:admin-api')->post('/posts/{id}','PostsController@update');

Route::get('/posts-per-month','PostsController@getcountbymonth');

Route::get('/posts/months/{id}','PostsController@getbymonth');

Route::get('/posts/tags/{id}','TagsController@getpostsbytag');



//Breaking news routers
Route::get('/breaking-news','PostsController@getbreakingnews');

Route::get('/featured-posts','PostsController@getfeaturedposts');

//Only loged in users can make comments
Route::middleware('auth:api')->post('/comments','CommentsController@store');

//Categories routers

Route::get('/categories','CategoriesController@index');

Route::get('/categories/{id}','PostsController@postsbycategory');

Route::get('/categories-data/{id}','CategoriesController@show');

Route::middleware('auth:admin-api')->post('/categories','CategoriesController@store');

Route::middleware('auth:admin-api')->put('/categories/{id}','CategoriesController@update');

Route::middleware('auth:admin-api')->delete('/categories/{id}','CategoriesController@destroy');


//Comments routers

Route::get('/comments','CommentsController@index');

Route::middleware('auth:admin-api')->delete('/comments/{id}','CommentsController@destroy');


//Tags routers

Route::get('/tags','TagsController@index');

Route::get('/tags/{id}','TagsController@show');

Route::middleware('auth:admin-api')->put('/tags/{id}','TagsController@update');

Route::middleware('auth:admin-api')->delete('/tags/{id}','TagsController@destroy');

Route::middleware('auth:admin-api')->post('/tags','TagsController@store');


//Users routers

Route::middleware('auth:admin-api')->get('/users/block','UsersController@blocked');

Route::middleware('auth:admin-api')->put('/users/block/{id}','UsersController@unblock');



//Roles routers
Route::middleware('auth:admin-api')->get('/roles','RolesController@index');


//Admins routers

/*Create a new admin for your backend  this route is only accesible to admins 
with the role of super admin */


Route::middleware('auth:admin-api','checkrole')->post('/admins','AdminUsersController@store');


