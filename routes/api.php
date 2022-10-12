<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AnswerController;
use App\Http\Controllers\API\QuestionController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    //User Control 
    Route::get('/edituser/{id}', [UserController::class, 'edit']);
    Route::get('/user', [UserController::class, 'index']);
    Route::post('/updateuser/{id}', [UserController::class, 'update']);
    Route::post('/deleteuser/{id}', [UserController::class, 'update']);

    //Answer Control
    Route::post('/createanswer', [AnswerController::class, 'store']);

    //Question Control
    Route::post('/createquestion', [QuestionController::class, 'store']);
    Route::get('/showquestion/{id}', [QuestionController::class, 'show']);
    Route::get('/question', [QuestionController::class, 'index']);

    
});
Route::post('/createconsultant', [UserController::class, 'storeconsultant']);
Route::post('/createcustomer', [UserController::class, 'storecustomer']);
Route::post('/login', [AuthController::class, 'login']);
