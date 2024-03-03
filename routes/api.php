<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '', 'middleware' => ['saveApiAudit']], function () {
	//Route::post('register', [App\Http\Controllers\Api\AuthController::class, 'register']);
	Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);
	Route::post('verify-otp', [App\Http\Controllers\Api\AuthController::class, 'verifyOtp']);
	
	
	Route::group(['middleware' => ['authApi']], function () {
		
		//User
		Route::post('logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
		Route::post('change-password', [App\Http\Controllers\Api\AuthController::class, 'changePasswordUpdate']);
		Route::post('edit-profile', [App\Http\Controllers\Api\AuthController::class, 'editProfile']);
		Route::post('get-user-details', [App\Http\Controllers\Api\AuthController::class, 'getUserDetails']);
		
		//Master property data
		Route::post('get-property-for', [App\Http\Controllers\Api\MasterPropertyData::class, 'getPropertyfor']);
		Route::post('get-property-type', [App\Http\Controllers\Api\MasterPropertyData::class, 'getPropertytype']);
		Route::post('get-available-from', [App\Http\Controllers\Api\MasterPropertyData::class, 'getAvailablefrom']);
		Route::post('get-furnishing-status', [App\Http\Controllers\Api\MasterPropertyData::class, 'getFurnishingstatus']);
		Route::post('get-age-of-property', [App\Http\Controllers\Api\MasterPropertyData::class, 'getAgeofProperty']);
		Route::post('get-property-view', [App\Http\Controllers\Api\MasterPropertyData::class, 'getPropertyview']);
		Route::post('get-measurement', [App\Http\Controllers\Api\MasterPropertyData::class, 'getMeasurement']);
		Route::post('get-price-type', [App\Http\Controllers\Api\MasterPropertyData::class, 'getPricetype']);
		Route::post('get-security-deposit', [App\Http\Controllers\Api\MasterPropertyData::class, 'getSecuritydeposit']);
		Route::post('get-amenities', [App\Http\Controllers\Api\MasterPropertyData::class, 'getAmenities']);
		Route::post('get-building-type', [App\Http\Controllers\Api\MasterPropertyData::class, 'getBuildingtype']);
		Route::post('get-location', [App\Http\Controllers\Api\MasterPropertyData::class, 'getLocation']);
		
		//Property
		Route::post('get-property', [App\Http\Controllers\Api\PropertyController::class, 'getProperty']);
		Route::post('add-property', [App\Http\Controllers\Api\PropertyController::class, 'addProperty']);
		Route::post('update-property', [App\Http\Controllers\Api\PropertyController::class, 'update']);
		Route::post('delete-property', [App\Http\Controllers\Api\PropertyController::class, 'deleteProperty']);
		Route::post('get-property-view', [App\Http\Controllers\Api\PropertyController::class, 'propertyView']);
		Route::post('get-property-by-user', [App\Http\Controllers\Api\PropertyController::class, 'getUserByProperty']);
	});
});
