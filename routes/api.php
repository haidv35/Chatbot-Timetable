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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::any('webhook', "WebhookController@index");
Route::get('exists_student_code', "WebhookController@existsStudentCode")->name('exists_student_code');
Route::get('get_image', "WebhookController@getImage")->name('get_image');
Route::get('get_today_text', "WebhookController@getTodayText")->name('get_today_text');
Route::get('get_week_text', "WebhookController@getWeekText")->name('get_week_text');

Route::get('messenger_profile', "Configurations\MessengerProfileController@index");
Route::prefix("persistent_menu")->group(function () {
    Route::get("edit/{user?}", "Configurations\PersistentMenuController@update");
    Route::get("delete/{user?}", "Configurations\ConfigurationController@delete");
});
Route::get('get_started', "Configurations\GetStartedController@update");
