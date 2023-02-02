<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;


Auth::routes();

Route::get('/home', [App\Http\Controllers\Site\SiteController::class, 'home'])->name('home');

/***

 *
 *** Site Routes
 *

**/

Route::controller(SiteController::class)->group(function(){
    Route::get('/', 'home');
    Route::get('/about', 'about')->name('about');
    Route::get('/post-detail/{id}', 'postDetails')->name('post.detail');
});





/***

 *
 *** Backend Routes
 *

**/


Route::group(['prefix' => 'admin'], function(){
    Route::middleware('admin')->group(function(){
        Route::controller(AdminController::class)->group(function(){
            Route::get('/dashboard', 'dashboard')->name('admin.dashboard');
        });

        Route::controller(CategoryController::class)->group(function(){
            Route::prefix('categories')->group(function(){
                Route::get('/', 'index')->name('category.index');
                Route::post('/store', 'store')->name('category.store');
                Route::any('/update', 'update')->name('category.update');
                Route::get('/delete/{id}', 'delete')->name('category.delete');
            });
        });

        Route::controller(PostController::class)->group(function(){
            Route::prefix('posts')->group(function(){
                Route::get('/', 'index')->name('post.index');
                Route::get('/create', 'create')->name('post.create');
                Route::post('/store', 'store')->name('post.store');
                Route::get('/edit/{id}', 'edit')->name('post.edit');
                Route::post('/update/{id}', 'update')->name('post.update');
                Route::get('/delete/{id}', 'delete')->name('post.delete');
            });
        });
    });

});
