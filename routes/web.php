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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get("/", "PostController@index")->name("posts.index");

//  Post routes
// Route::get("/posts", "PostController@index")->name("posts.index");
//  Only logged users can create posts
Route::get("/posts/create", "PostController@create")->name("posts.create")->middleware("auth");
Route::post("/posts", "PostController@store")->name("posts.store")->middleware("auth");
Route::get("/posts/{post}", "PostController@show")->name("posts.show");

Route::get("users/{user}/post", "PostController@userPosts")->name("user.posts");
