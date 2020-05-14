<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix'=>'member'],function (){
    Route::post('/add','MemberController@addMember');
    Route::get('/lst','MemberController@showMember');
});
Route::group(['prefix'=>'medicine'],function(){
    Route::post('/add','MedicineController@addMedicine');
    Route::get('/lst','MedicineController@showMedicine');
});
Route::group(['prefix'=>'notice'],function(){
    Route::post('/add','NoticeController@addNotice');
    Route::get('/lst','NoticeController@showNotice');
    Route::get('/del/{id}','NoticeController@delNotice');
});

Route::group(['prefix'=>'transbigiot'],function(){
    Route::get('/getPressure','TransBigiotController@getPressure');
    Route::get('/getTemp','TransBigiotController@getTemp');
    Route::get('/getHum','TransBigiotController@getHum');
    Route::get('/getRecords','TransBigiotController@getRecords');
    Route::get('/openBox','TransBigiotController@openBox');
    Route::get('/isNotice','TransBigiotController@isNotice');
});
