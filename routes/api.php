<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user',[UserController::class, 'user']);
    Route::post('/user-update',[UserController::class,'userUpdate']);

});
