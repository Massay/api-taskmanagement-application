<?php

use Illuminate\Http\Request;

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

// Route::middleware('api')->get('',function(){
//     return 'hi';
// });

Route::group(['middleware' => ['api','cors']], function () {
    Route::post('login','AuthController@login');
    
    Route::post('register','AuthController@register');
});
Route::resource('categories','CategoryController');
Route::resource('status','StatusController');

Route::post('complete/{task}','TaskController@markComplete');
Route::post('open/{task}','TaskController@markOpen');
Route::post('cancel/{task}','TaskController@markCancelled');
Route::post('hold/{task}','TaskController@markHold');
Route::post('activate/{task}','TaskController@markOpen');
Route::post('on-going/{task}','TaskController@markOngoing');

Route::group(['middleware' => ['jwt.auth','api','cors']], function () {
    Route::post('users/{user}/assign-role','UserController@assignRole');    
    Route::resource('users','UserController');
    Route::resource('comments','CommentController');
    Route::resource('tasks','TaskController');
	 Route::post('important/{task}','TaskController@markImportant');
	Route::post('unimportant/{task}','TaskController@markUnImportant');

} );



// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::group(['middleware' => ['api','cors']], function () {
//     Route::post('login', 'AuthController@login');
//     Route::post('register', 'AuthController@register');

    // Route::group(['middleware' => 'jwt.auth'], function () {

    // });
    // Route::group(['middleware' => 'jwt.auth'], function () {
    //         Route::post('logout','AuthController@logout');
    //         Route::resource('category','CategoryController');
    //         Route::resource('task','TaskController');
    //         Route::get('task/group/{group_by}','TaskController@PriorityTask');
    //         Route::get('user','AuthController@user');
    //         Route::get('task/shedule/today','TaskController@todayTask');
    //         Route::get('task/shedule/yesterday','TaskController@yesterdayTask');
    //         Route::get('task/shedule/tomorrow','TaskController@tomorrowTask');
    //         Route::get('task/shedule/late','TaskController@lateTask');

    //         // Route::resource('task','TaskController');
    //         Route::resource('status','StatusController');
    // });
//});
