<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\customer\CutomerController;

use App\Http\Controllers\API\customer\VendorController;
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

Route::post('/update-password', [CutomerController::class, 'update_password'])->name('update-password');

/* ************** Costomer Api ***************/
Route::post('/vendor-ragister', [VendorController::class, 'vendor_ragister'])->name('vendor-ragister');

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/user-logout', [CutomerController::class, 'user_logout'])->name('user-logout');
});
