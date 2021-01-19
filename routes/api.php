<?php

use App\Http\Controllers\Api\Admin\AdminController;
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
 * changLang==> ده بيجيب الداتا من الداتابيز علي اساس لغه الموقع هل هي عربي او انجليزي 
 * checkAdminLogin:admin-api => ده عشان يعمل اتشيك هل اليوزر ده معموله توكن من jwt
 */
Route::group(['prefix' => 'users','middleware'=>['api','apiCheckPassword','changeLang']], function () {
    Route::get('/', [UserController::class,'index']);
    Route::post('get-user', [UserController::class,'getUserById']);
    Route::post('add-user', [UserController::class,'store']);
});



Route::group(['prefix' => 'admin','middleware'=>['api','apiCheckPassword','changeLang','checkAdminLogin:admin-api']], function () {
    /* 
    * ده انا شيلن من عليه الميدل وير بتاع الادمن تشيك عشان دي بتطلب ان اليوزر يكون اتعمل معاه جنريت لكود من خلال jwt
    * ف انا لسه ماسجلتش عشان يعمل جينيرات للتوكن ده
    */
    Route::post('login', [AdminController::class,'adminLogin'])->withoutMiddleware('checkAdminLogin:admin-api');
});