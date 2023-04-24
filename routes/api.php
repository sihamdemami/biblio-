<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\livrecontroller;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::post("login",[UserController::class, 'login']);
     
Route::post("AddUser",[UserController::class,'AddUser']);

Route::group(['middleware' => 'auth:sanctum'], function(){
           
           // crud users
    Route::post("logout",[UserController::class, 'logout']);   
    Route::get("getAll/{id?}",[UserController::class,'getlist']);
    Route::put("UpdateUser", [UserController::class, 'update']);
    Route::delete("DestroyUser", 'App\Http\Controllers\UserController@deleteUser');
    });

Route::group(['middleware' => 'auth:sanctum'], function(){
   
           // crud tables
    Route::get("list/{id?}",[livrecontroller::class,'list']);
    Route::post("Addlivre",[livrecontroller::class,'addlivre']);
    Route::put("Updatelivres/{id}", [livrecontroller::class, 'update']);
    Route::delete("DestroyLivre/{id}", 'App\Http\Controllers\livrecontroller@destroy');      
    });
