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
Auth::routes(['verify' => true]);

//USER RELATED ROUTE
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/register', 'ProfileController@counteries');
Route::put('/profile/{userID}','ProfileController@updateProfile');
Route::get('/profile','UserController@profile');
Route::get('/profile/{userID}/edit','UserController@ProfileEdit');

//ADMIN
Route::get('/admin/user', 'UserController@index');
Route::delete('/admin/user/{user}/destroy', 'UserController@destroy');

//ROUTE HOME
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//POST ROUTE
Route::get('/StayHomeTopic','PostController@index');
Route::post('/StayHomeTopic/post','PostController@create');
Route::get('/post/{post}/delete','PostController@delete');
Route::get('/StayHomeTopic/post/{post}/edit','PostController@edit');
Route::post('/StayHomeTopic/post/{post}/update','PostController@update');
Route::post('/post/{post}/comment/submit','CommentController@postComment');
Route::get('/post/{post}/comment','CommentController@getComment');
Route::post('/post/{post}/comment/{comment}/delete','CommentController@delComment');
Route::post('/post/{post}/comment/{comment}/like', 'CommentController@store');
Route::delete('/post/{post}/comment/{comment}/like', 'CommentController@destroy');

//PERSONAL POST ROUTE
Route::get('personal/StayHomeTopic','PersonalPostController@index');
Route::post('personal/StayHomeTopic/post','PersonalPostController@create');
Route::get('personal/StayHomeTopic/post/{post}/edit','PersonalPostController@edit');
Route::post('personal/StayHomeTopic/post/{post}/update','PersonalPostController@update');

Route::post('/StayHomeTopic/post/{post}/like', 'PostController@store');
Route::delete('/StayHomeTopic/post/{post}/like', 'PostController@destroy');

//simple function route (list of links for cv19 news)
Route::get('/C19News','WebsiteController@index');
Route::post('/C19News','WebsiteController@store');
Route::delete('/C19News/{Website}/delete','WebsiteController@delete');

//TAGS
Route::get('/Articles/createTag','ArticleController@createTag');
Route::post('/Articles/createTag','ArticleController@storeTag');
Route::delete('/Articles/createTag/{tag}/delete','ArticleController@deleteTag');

//ARTICLES
Route::get('/Articles','ArticleController@index');
Route::get('/Articles/create','ArticleController@create');
Route::post('/Articles/create/image_upload', 'ArticleController@upload')->name('upload');
Route::post('/Articles','ArticleController@store');
Route::get('/Articles/{article}','ArticleController@show');
Route::get('/Articles/{article}/edit','ArticleController@edit');
Route::put('/Articles/{article}','ArticleController@update');
Route::delete('/Articles/{article}/delete','ArticleController@delete');

//ARTICLES PERSONAL
Route::get('/personal/Articles','PersonalArticleController@index');
Route::get('/personal/Articles/create','PersonalArticleController@create');
Route::post('/personal/Articles/create/image_upload', 'PersonalArticleController@upload')->name('upload');
Route::post('/personal/Articles','PersonalArticleController@store');


//ARTICLE COMMENTS
Route::post('/Articles/{article}/comment/submit','ArticleCommentController@postComment');
Route::get('/Articles/{article}','ArticleCommentController@getComment');
Route::delete('/Articles/{article}/comment/{comment}/delete','ArticleCommentController@delComment');
Route::get('/Articles/{article}/comment/{comment}/edit','ArticleCommentController@edit');
Route::put('/Articles/{article}/comment/{comment}/update','ArticleCommentController@update');




