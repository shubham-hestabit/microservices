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


/**
 * Make Routes for Registeration and Login.
 */ 
Route::post('register',  [UserController::class, 'register']);

Route::post('login',  [UserController::class, 'login']); 


/**
 * Make Routes for Passport token authentication.
 */ 
Route::middleware('auth:api')->group(function(){

    Route::get('read/{id}',  [UserController::class, 'read']);

    Route::put('update/{id}',  [UserController::class, 'update']);

    Route::delete('delete/{id}',  [UserController::class, 'destroy']);

    Route::get('/logout', [UserController::class, 'logout']);
});


/**
 * Makr 'assign' and 'reads' Routes for student assigning and chaking assign table data.
 */
Route::put('assign/{id}',  [AdminController::class, 'assign'])->middleware('auth:api');

Route::get('reads',  [AdminController::class, 'read'])->middleware('auth:api');