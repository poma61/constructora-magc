<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\UserController;

//middleware('guest') si el usuario esta autenticado no permite que el usuario acceda a la vista login
//entonces esto redirige a la vista principal donde se configura en la siguiente ruta del archivo php
//app/Providers/RouteServiceProvider.php
Route::get('/',[LoginController::class,'index'])->name('r-view-login')->middleware('guest');
Route::post('/login',[LoginController::class,'login'])->name("r-login");
Route::get("/home",[HomeController::class,'index'])->name("r-home")->middleware("auth");
Route::get("/salir",[LoginController::class,'logout'])->name("r-salir")->middleware("auth");



//Personal
Route::group(["middleware"=>["auth"]],function(){
    Route::get('/personal/index/view/{city}',[PersonalController::class,'indexView'])->name("r-personal-index-view");
    Route::post('/personal/index',[PersonalController::class,'index']);
    Route::post('/personal/create',[PersonalController::class,'create']);
    Route::post('/personal/edit',[PersonalController::class,'edit']);
    Route::put('/personal/update',[PersonalController::class,'update']);
    Route::post('/personal/destroy',[PersonalController::class,'destroy']);
});


//User
Route::group(['middleware'=>['auth']],function(){
Route::get('/user/view',[UserController::class,'indexView'])->name('r-user-view');
Route::post('/user/index',[UserController::class, 'index']);
Route::post('/user/create',[UserController::class, 'create']);
Route::post('/user/edit',[UserController::class, 'edit']);
Route::put('/user/update',[UserController::class, 'update']);
Route::put('/user/destroy',[UserController::class, 'destroy']);
});