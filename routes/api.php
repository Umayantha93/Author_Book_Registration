<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BookController;
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

Route::post('register',[UserController::class, "register"]);
Route::post('login',[UserController::class, "login"]);

Route::group(['middleware' => ['auth:api']], function(){
    Route::post('profile',[UserController::class, "profile"]);
    Route::post('logout',[UserController::class, "logout"]);

    Route::get('admin-profile',[UserController::class, "adminProfile"])->middleware('is_admin');
    Route::put('update-author/{id}',[UserController::class, "updateAuthor"])->middleware('is_admin');

    Route::post('create-book',[BookController::class, "createBook"]);
    Route::post('delete-book/{id}',[BookController::class, "daleteBook"]);
    Route::post('show-books',[BookController::class, "showBooks"]);
    
});