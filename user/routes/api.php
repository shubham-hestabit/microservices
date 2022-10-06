<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController; 

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// User Routes
Route::post('register',  [UserController::class, 'create']);

Route::post('login',  [UserController::class, 'login']); 


// Passport token routes
Route::middleware('auth:api')->group(function(){

    Route::get('read/{id}',  [UserController::class, 'read']);

    Route::put('update/{id}',  [UserController::class, 'update']);

    Route::delete('delete/{id}',  [UserController::class, 'destroy']);

    Route::get('/logout', [UserController::class, 'logout']);
});


//assign table related routes
Route::put('assign/{main_id}',  [AdminController::class, 'assign'])->middleware('auth:api');

Route::get('reads',  [AdminController::class, 'read'])->middleware('auth:api');