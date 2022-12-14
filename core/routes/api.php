<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Assign;
use App\Http\Controllers\UserDataController;

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
 * Below two routes belong to Admin for assign and approval Functionality.
 */
Route::put('/assign/{id}', [Assign::class, 'assign']);

Route::get('/reads', [Assign::class, 'assignedData']);


/** 
 * Make below routes for Login and Registeration functionality and also for performing CRUD operations.
 */
Route::post('/register',  [UserDataController::class, 'register']);

Route::post('/login',  [UserDataController::class, 'login']);

Route::get('/logout', [UserDataController::class, 'logout']);

Route::get('/read/{id}',  [UserDataController::class, 'read']);

Route::put('/update/{id}',  [UserDataController::class, 'update']);

Route::delete('/delete/{id}',  [UserDataController::class, 'destroy']);