<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\API\customer\CutomerController;
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
   Route::post('/sign_in', [CutomerController::class, 'sign_in'])->name('sign_in');

   Route::post('/signup', [CutomerController::class, 'signup'])->name('signup');
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware' => ['auth:sanctum']], function () {

    //  Route::get('/inspirationp-get-data', [ApiController::class, 'inspiration_get_data'])->name('inspiration-get-data');
});