<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\CategoryController;


Route::middleware(['SaveIpUser'])->group(function () {
    Route::get('/', [HomeController::class,'index']);
    Route::get('/about', function(){
        return view('user.About');
    });
    Route::get('/Category', [CategoryController::class,'index']);
    Route::get('/Post', [PostController::class,'ListPost']);
});

