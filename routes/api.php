<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/**
 * ************** MIDDLEWARE COMMENTS *****************
 * ApiCheckPassword==> ده بيحط باسورد علي ال اي بي اي كله و بيشوف هل هو كتب الباسورد بتاع ال اي بي اي صح ولا غلط
 *  changLang==> ده بيجيب الداتا من الداتابيز علي اساس لغه الموقع هل هي عربي او انجليزي 
 */
Route::group(['prefix' => 'users','middleware'=>['api','apiCheckPassword','changeLang']], function () {
    Route::get('/', [UserController::class,'index']);
});