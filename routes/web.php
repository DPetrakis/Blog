<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post/{id}','PostViews@showpost');

Route::get('/categories/{category}','CategoriesController@categorypage');

Route::get('/about-us','PagesController@aboutus')->name('about-us');

Route::get('/contact-us','PagesController@contactus')->name('contact-us');

Route::post('/users/logout','Auth\LoginController@userLogout')->name('user.logout');

Route::get('/postsbymonth/{id}','PostsController@getbymonth');

Route::get('/months/{month}','PostsController@returnmonthpage');

Route::get('/tags/{tag}','TagsController@returntagpage');

Route::prefix('admin')->group(function(){
 
    Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login','Auth\AdminLoginController@login')->name('admin.login.sumbit');
    Route::get('/','AdminController@index')->name('admin.dashboard');
    Route::get('/posts','AdminController@postspage')->name('admin.posts');
    Route::get('/categories','AdminController@categoriespage')->name('admin.categories');
    Route::get('/comments','AdminController@commentspage')->name('admin.comments');
    Route::get('/tags','AdminController@tagspage')->name('admin.tags');
    Route::get('/blocks','AdminController@blockspage')->name('admin.blocks');
    Route::get('/posts/{id}/edit','PostsController@edit');
    Route::middleware('checkrole')->get('/roles','AdminController@rolespage')->name('admin.roles');
    Route::post('/logout','Auth\AdminLoginController@logout')->name('admin.logout');

});

