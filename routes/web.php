<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', 'HomeController@index')->name('home');


    Route::namespace('App\Http\Controllers\Post')->group(function () {

        Route::get('/posts', 'IndexController')->name('post.index');
        Route::get('/posts/create', 'CreateController')->name('post.create');

        Route::post('/posts', 'StoreController')->name('post.store');
        Route::get('/posts/{post}', 'ShowController')->name('post.show');
        Route::get('/posts/{post}/edit', 'EditController')->name('post.edit');
        Route::patch('/posts/{post}', 'UpdateController')->name('post.update');
        Route::delete('/posts/{post}', 'DestroyController')->name('post.delete');


        Route::namespace('Admin')->prefix('admin')->middleware('admin')->group(function (){

            Route::namespace('Post')->group(function (){
                Route::get('/post', 'IndexController')->name('admin.post.index');
            });

        });

        Route::get('/posts/update', 'PostController@update');
        Route::get('/posts/delete', 'PostController@delete');
        Route::get('/posts/first_or_create', 'PostController@firstOrcreate');
        Route::get('/posts/update_or_create', 'PostController@updateOrcreate');

        Route::get('/main', 'MainController@index')->name('main.index');
        Route::get('/contacts', 'ContactController@index')->name('contact.index');
        Route::get('/about', 'AboutController@index')->name('about.index');

    });







Auth::routes();

Route::get('', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


