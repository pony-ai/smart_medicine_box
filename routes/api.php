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
Route::group(['prefix'=>'medicine'],function(){
    Route::post('/add','MedicineController@addMedicine');
    Route::get('/lst','MedicineController@showMedicine');
});
Route::group(['prefix'=>'notice'],function(){
    Route::post('/add','NoticeController@addNotice');
    Route::get('/lst','NoticeController@showNotice');
});
Route::group(['prefix'=>'member'],function (){
    Route::post('/add','MemberController@addMember');
    Route::get('/lst','MemberController@showMember');
});
