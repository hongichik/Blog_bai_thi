<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\authController;
use Illuminate\Support\Facades\Auth;


Route::middleware(['throttle:ip_address'])->group(function () {
    Route::get('/login', [authController::class,'index'])->name('admin.login');
    Route::get('/logout', [authController::class,'logout']);
    Route::post('/login', [authController::class,'checkLogin']);
});

Route::middleware('auth')->group(function (){
    Route::get('/{any?}', function () {
        return view('admin.admin',['name_admin'=>Auth::user()->name, 'image'=>Auth::user()->image]);
    })->where('any', '.*?');
});