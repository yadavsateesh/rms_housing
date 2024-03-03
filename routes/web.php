<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Dashboard
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

//Edit Profile
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('admin.profile');
Route::post('/profile-update', [App\Http\Controllers\ProfileController::class, 'update'])->name('admin.profile.update');

//Change Password
Route::get('/change-password', [App\Http\Controllers\ProfileController::class, 'changePassword'])->name('admin.change.password');
Route::post('/change-password-update', [App\Http\Controllers\ProfileController::class, 'changePasswordUpdate'])->name('admin.change.password.update');

//Property For
Route::resource('/property-for', App\Http\Controllers\PropertyForController::class);
Route::post('/property-for-list', [App\Http\Controllers\PropertyForController::class, 'propertyForlist'])->name('property-for-list');
Route::get('/property-for/delete/{property_for}', [App\Http\Controllers\PropertyForController::class, 'delete'])->name('property-for.delete');

//Building Type
Route::resource('/building-type', App\Http\Controllers\BuildingTypeController::class);
Route::post('/building-type-list', [App\Http\Controllers\BuildingTypeController::class, 'buildingTypelist'])->name('building-type-list');
Route::get('/building-type/delete/{building_type}', [App\Http\Controllers\BuildingTypeController::class, 'delete'])->name('building-type.delete');

//Property Type
Route::resource('/property-type', App\Http\Controllers\PropertyTypeController::class);
Route::post('/property-type-list', [App\Http\Controllers\PropertyTypeController::class, 'propertyTypelist'])->name('property-type-list');
Route::get('/property-type/delete/{property_type}', [App\Http\Controllers\PropertyTypeController::class, 'delete'])->name('property-type.delete');

//Available From
Route::resource('/available-from', App\Http\Controllers\AvailableFromController::class);
Route::post('/available-from-list', [App\Http\Controllers\AvailableFromController::class, 'availableFromlist'])->name('available-from-list');
Route::get('/available-from/delete/{available_from}', [App\Http\Controllers\AvailableFromController::class, 'delete'])->name('available-from.delete');

//Furnishing Status
Route::resource('/furnishing-status', App\Http\Controllers\FurnishingStatusController::class);
Route::post('/furnishing-status-list', [App\Http\Controllers\FurnishingStatusController::class, 'furnishingStatuslist'])->name('furnishing-status-list');
Route::get('/furnishing-status/delete/{furnishing_status}', [App\Http\Controllers\FurnishingStatusController::class, 'delete'])->name('furnishing-status.delete');

//Age of Property
Route::resource('/age-of-property', App\Http\Controllers\AgeOfPropertyController::class);
Route::post('/age-of-property-list', [App\Http\Controllers\AgeOfPropertyController::class, 'ageOfpropertyList'])->name('age-of-property-list');
Route::get('/age-of-property/delete/{age_of_property}', [App\Http\Controllers\AgeOfPropertyController::class, 'delete'])->name('age-of-property.delete');

//Property View
Route::resource('/property-view', App\Http\Controllers\PropertyViewController::class);
Route::post('/property-view-list', [App\Http\Controllers\PropertyViewController::class, 'propertyViewlist'])->name('property-view-list');
Route::get('/property-view/delete/{property_view}', [App\Http\Controllers\PropertyViewController::class, 'delete'])->name('property-view.delete');

//Measurement
Route::resource('/measurement', App\Http\Controllers\MeasurementController::class);
Route::post('/measurement-list', [App\Http\Controllers\MeasurementController::class, 'measurementlist'])->name('measurement-list');
Route::get('/measurement/delete/{measurement}', [App\Http\Controllers\MeasurementController::class, 'delete'])->name('measurement.delete');

//Price Type
Route::resource('/price-type', App\Http\Controllers\PriceTypeController::class);
Route::post('/price-type-list', [App\Http\Controllers\PriceTypeController::class, 'priceTypelist'])->name('price-type-list');
Route::get('/price-type/delete/{property_type}', [App\Http\Controllers\PriceTypeController::class, 'delete'])->name('price-type.delete');

//Price Type
Route::resource('/security-deposit', App\Http\Controllers\SecurityDepositController::class);
Route::post('/security-deposit-list', [App\Http\Controllers\SecurityDepositController::class, 'securityDepositlist'])->name('security-deposit-list');
Route::get('/security-deposit/delete/{property_type}', [App\Http\Controllers\SecurityDepositController::class, 'delete'])->name('security-deposit.delete');

//Amenities
Route::resource('/amenities', App\Http\Controllers\AmenitiesController::class);
Route::post('/amenities-list', [App\Http\Controllers\AmenitiesController::class, 'amenitiesList'])->name('amenities-list');
Route::get('/amenities/delete/{amenities}', [App\Http\Controllers\AmenitiesController::class, 'delete'])->name('amenities.delete');

//Property
Route::resource('/property', App\Http\Controllers\PropertyController::class);
Route::post('/property-list', [App\Http\Controllers\PropertyController::class, 'propertyList'])->name('property-list');
Route::get('/property/delete/{property}', [App\Http\Controllers\PropertyController::class, 'delete'])->name('property.delete');
Route::get('/property/property-image-delete/{property_image}', [App\Http\Controllers\PropertyController::class, 'propertyImagedelete'])->name('property.property-image-delete');

Route::get('/property/property-verification/{property}/{status}', [App\Http\Controllers\PropertyController::class, 'propertyVerification'])->name('property.property-verification');

//CMS Page
Route::resource('/cmspage', App\Http\Controllers\CmsPageController::class);
Route::post('/cmspage-list', [App\Http\Controllers\CmsPageController::class, 'cmsPagelist'])->name('cmspage-list');

//Users
Route::resource('/user', App\Http\Controllers\UserController::class);
Route::get('/user-list/{user_type}', [App\Http\Controllers\UserController::class, 'index'])->name('user-list');
Route::post('/visitor-list', [App\Http\Controllers\UserController::class, 'visttorList'])->name('visitor-list');
Route::post('/agent-list', [App\Http\Controllers\UserController::class, 'agentList'])->name('agent-list');
Route::get('/user/delete/{user}', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');
Route::get('change-status/{user}/{status}', [App\Http\Controllers\UserController::class, 'userBlock'])->name('user.change-status');

//Location
Route::resource('/location', App\Http\Controllers\LocationController::class);
Route::post('/location-list', [App\Http\Controllers\LocationController::class, 'locationList'])->name('location-list');
Route::get('/location/delete/{location}', [App\Http\Controllers\LocationController::class, 'delete'])->name('location.delete');