<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\BlogController;
use App\Http\Controllers\User\SearchController;

Route::middleware(['SaveIpUser'])->group(function () {
    Route::get('/', [HomeController::class,'index']);
    Route::get('/about', function(){
        return view('user.About');
    });
    Route::get('/contact', function ()
    {
        return view('user.Contact');
    });

    Route::get('/viewCommentBlog', [BlogController::class,'viewCommentBlog']);
    Route::get('/Blog', [BlogController::class,'ListBlog']);
    Route::get('/Blog/{nameBlog}', [BlogController::class,'index']);

    Route::get('/Search', [SearchController::class,'index']);

    Route::get('/Category/{NameCategory}', [CategoryController::class,'index']);

    Route::get('/viewCommentPost', [PostController::class,'viewCommentPost']);
    Route::get('/Post/{NamePost}', [PostController::class,'ListPost']);
    Route::get('/PostChill/{NamePost}/{NamePostChill}', [PostController::class,'PostChill']);

});

