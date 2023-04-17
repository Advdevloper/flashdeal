<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\customer\CutomerController;

use App\Http\Controllers\API\vendor\VendorController;
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
/* ************** Costomer Api ***************/

Route::post('/sign_in', [CutomerController::class, 'sign_in'])->name('sign_in');

Route::post('/signup', [CutomerController::class, 'signup'])->name('signup');

Route::post('/verify-otp', [CutomerController::class, 'verify_otp'])->name('verify-otp');

Route::post('/resend-otp', [CutomerController::class, 'resend_otp'])->name('resend-otp');

Route::post('/forgot-password', [CutomerController::class, 'forgot_password'])->name('forgot-password');

// Route::post('/update-password', [CutomerController::class, 'update_password'])->name('update-password');

/* ************** Vendor Api ***************/
Route::post('/vendor-ragister', [VendorController::class, 'vendor_ragister'])->name('vendor-ragister');

Route::post('/vendor-sign-in', [VendorController::class, 'vendor_sign_in'])->name('vendor-sign-in');

Route::post('/vendor-forgot-password', [VendorController::class, 'vendor_forgot_password'])->name('vendor-forgot-password');

Route::group(['middleware' => ['auth:sanctum']], function () {
    /* ************** User Api ***************/
    Route::post('/language-upadet', [CutomerController::class, 'language_upadet'])->name('language-upadet');

    Route::post('/gender-upadet', [CutomerController::class, 'gender_upadet'])->name('gender-upadet');

    Route::get('/costomer-profile/{id}', [CutomerController::class, 'costomer_profile'])->name('costomer-profile');

    Route::get('/user-logout', [CutomerController::class, 'user_logout'])->name('user-logout');

    /* ************** Vendor Api ***************/
    Route::get('/vendor-profile/{id}', [VendorController::class, 'vendor_profile'])->name('vendor-profile');
    /* ************** all data Api ***************/
    Route::get('/slider-data', [CutomerController::class, 'slider_data'])->name('slider-data');
});
