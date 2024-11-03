<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\PatientController;
use App\Http\Controllers\api\AppointmentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user',[UserController::class, 'user']);
    Route::delete('/user-delete',[UserController::class, 'userDelete']);
    Route::post('/user-update',[UserController::class,'userUpdate']);


});
Route::get('patients',[PatientController::class,'index']);
Route::post('create-patient',[PatientController::class,'create']);
Route::post('update-patient/{id}',[PatientController::class,'update']);
Route::delete('delete-patient/{id}',[PatientController::class,'delete']);


Route::post('create-appointment',[AppointmentController::class,'store']);
Route::get('all-appointment',[AppointmentController::class,'index']);
Route::post('update-appointment/{id}',[AppointmentController::class,'update']);
Route::get('get-appointment/{id}',[AppointmentController::class,'getAppointment']);
Route::get('update-status-appointment/{id}',[AppointmentController::class,'updateStatus']);
Route::delete('delete-appointment/{id}',[AppointmentController::class,'delete']);
Route::get('restore-appointment/{id}',[AppointmentController::class,'restoreAppointment']);