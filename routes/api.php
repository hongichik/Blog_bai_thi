<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\imageController;
use App\Http\Controllers\API\PermissionController;
use App\Http\Controllers\API\categoryController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\PostChillController;
use App\Http\Controllers\API\BlogController;
use App\Http\Controllers\API\AboutController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\VisitorControllor;


Route::middleware('auth')->group(function (){
    Route::get('/ListUser', [VisitorControllor::class,'ListUser']);
    Route::get('/ListVisitor', [VisitorControllor::class,'ListVisitor']);

    Route::post('/Comment', [CommentController::class,'index']);
    Route::get('/ListComment', [CommentController::class,'ListComment']);
    Route::get('/ListALLComment', [CommentController::class,'ListALLComment']);
    Route::get('/UpdateComment', [CommentController::class,'UpdateComment']);
    Route::get('/DeleteComment', [CommentController::class,'DeleteComment']);


    Route::post('/CeaterContact', [ContactController::class,'CeaterContact']);
    Route::get('/GetContact', [ContactController::class,'GetContact']);
    Route::get('/DeleteContact', [ContactController::class,'DeleteContact']);

    Route::post('/UpdateAbout', [AboutController::class,'UpdateAbout']);
    Route::get('/getAbout', [AboutController::class,'getAbout']);

    Route::get('/getBlog', [BlogController::class,'getBlog']);
    Route::post('/UpdateBlog', [BlogController::class,'UpdateBlog']); 
    Route::post('/NewBlog', [BlogController::class,'NewBlog']); 
    Route::get('/CountBlog', [BlogController::class,'CountBlog']);
    Route::get('/ListBlog', [BlogController::class,'ListBlog']);
    Route::get('/CountAllBlog', [BlogController::class,'CountAllBlog']);
    Route::get('/ListAllBlog', [BlogController::class,'ListAllBlog']);
    Route::get('/DeleteBlog', [BlogController::class,'DeleteBlog']);

    Route::post('/UpdatePostChill', [PostChillController::class,'UpdatePostChill']); 
    Route::get('/getPostchill', [PostChillController::class,'getPostchill']); 
    Route::post('/NewPostChill', [PostChillController::class,'NewPostChill']); 
    Route::get('/ListPostChill', [PostChillController::class,'ListPostChill']); 
    Route::get('/CountPostChill', [PostChillController::class,'CountPostChill']); 
    Route::get('/DeletePostChill', [PostChillController::class,'DeletePostChill']); 

    Route::get('/getPost', [PostController::class,'getPost']); 
    Route::post('/NewPost', [PostController::class,'NewPost']); 
    Route::post('/UpdatePost', [PostController::class,'UpdatePost']); 
    Route::get('/DeletePost', [PostController::class,'DeletePost']); 
    Route::get('/ListPost', [PostController::class,'ListPost']); 
    Route::get('/CountPost', [PostController::class,'CountPost']); 
    Route::get('/ListAllPost', [PostController::class,'ListAllPost']); 
    Route::get('/CountAllPost', [PostController::class,'CountAllPost']); 

    Route::post('/newCategory', [categoryController::class,'newCategory']); //new category
    Route::get('/ShowPatherCategory', [categoryController::class,'ShowPatherCategory']); //show
    Route::post('/DeleteCategory', [categoryController::class,'DeleteCategory']); //delete
    Route::post('/UpdateCategory', [categoryController::class,'UpdateCategory']); //update
    Route::get('/listAllCategory', [categoryController::class,'listAllCategory']); //show

    Route::get('/ShowPermissionAll', [PermissionController::class,'ShowPermissionAll']); // get all permission
    Route::get('/CheckPermission', [PermissionController::class,'CheckPermission']); // check permmission
    Route::get('/GetPermisson', [PermissionController::class,'GetPermisson']);
    Route::post('/NewAccount', [PermissionController::class,'NewAccount']);
    Route::get('/GetAllAdmin', [PermissionController::class,'GetAllAdmin']);
    Route::get('/DeleteAcount', [PermissionController::class,'DeleteAcount']);
    Route::get('/GetInfoAcount', [PermissionController::class,'GetInfoAcount']);
    Route::get('/GetInfoAcountPer', [PermissionController::class,'GetInfoAcountPer']);
    Route::post('/UpdateAcount', [PermissionController::class,'UpdateAcount']);
    Route::get('/GetInfo', [PermissionController::class,'GetInfo']);
    Route::post('/UpdateInfo', [PermissionController::class,'UpdateInfo']);

});

Route::get('/listCategory', [categoryController::class,'listCategory']); //show

Route::get('/ShowImg/{filename}', [imageController::class,'ShowImg']); //show img

