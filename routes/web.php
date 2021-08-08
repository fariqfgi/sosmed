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


// postingan
Route::get("/my-post/{post_id}", 'PostinganController@index');
Route::get("/post", 'PostinganController@create');
Route::post("/post", 'PostinganController@store');
Route::get("/post/{post_id}", 'PostinganController@show');
Route::get('/post/{post_id}/edit', 'PostinganController@edit');
Route::put('/post/{post_id}', 'PostinganController@update');
Route::delete('/post/{post_id}', 'PostinganController@destroy');

// post
Route::get('/home', 'HomeController@index');


// search
Route::get("/search", "UsersController@index");
Route::post("/search", "UsersController@store");
Route::get("/search-view/{User}", "UsersController@show");
Route::get('view-post/{User}', "UsersController@edit");


// Profile Settings
Route::get("/settings/{Profile}", "ProfileController@edit");
Route::put("/profile/update/{Profile}", "ProfileController@update");
Route::get("/profile/{profile}", "ProfileController@show");

// comment
Route::post('/comment', "KomentarController@store");
Route::delete('/comment/{comment_id}', 'KomentarController@destroy');
Route::get('/comment/{comment_id}/edit', 'KomentarController@edit');
Route::put('/comment/{comment_id}', 'KomentarController@update');
Route::get("/comment", function(){
    return view('app.comment-section');
});

// likes
Route::get('/likes/{postingan_likes}', "PostinganLikesController@create");
Route::get('/liked-post/{postingan_likes}', "PostinganLikesController@index");

//follow
Route::post('/follow', 'UsersController@follow');

// change password
Route::get('/change-password', "UsersController@create");
Route::post('/change-password/{User}', "UsersController@update");

// like comment
Route::get('/like-comment/{comment_id}/{post_id}', "PostinganController@liked");

Auth::routes();


