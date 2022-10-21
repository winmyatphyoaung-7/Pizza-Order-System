<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//get
Route::get('product/list',[RouteController::class,'productList']);
Route::get('category/list',[RouteController::class,'categoryList']);

//post
Route::post('category/create',[RouteController::class,'categoryCreate']);
Route::post('contact/create',[RouteController::class,'contactCreate']);

//delete
Route::post('contact/delete',[RouteController::class,'contactDelete']);
Route::get('contact/detail/{id}',[RouteController::class,'contactDetail']);

//update

Route::post('contact/update/',[RouteController::class,'contactUpdate']);


//localhost:8000/api/product/list
//localhost:8000/api/category/list
//localhost:8000/api/category/create
//localhost:8000/api/contact/create
//localhost:8000/api/contact/delete



