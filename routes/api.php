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

Route::group(['prefix' => 'v1',], function () {
    Route::group(['prefix' => 'user',], function () {
        Route::post('/login', [\App\Http\Controllers\API\V1\AuthController::class, 'login']);
        Route::post('/register', [\App\Http\Controllers\API\V1\AuthController::class, 'register']);
        Route::post('/forgot-password', [\App\Http\Controllers\API\V1\AuthController::class, 'forgotPassword']);
        Route::post('/reset-password', [\App\Http\Controllers\API\V1\AuthController::class, 'resetPassword']);

        Route::group(['middleware' => 'auth:sanctum'], function () {
            Route::put('/change-password', [\App\Http\Controllers\API\V1\AuthController::class, 'changePassword']);
            Route::get('/profile', [\App\Http\Controllers\API\V1\AuthController::class, 'profile']);

            Route::group(['prefix' => 'houses'], function () {
                Route::get('/', [\App\Http\Controllers\API\V1\User\HouseController::class, 'index']);
                Route::get('/{houseId}/amenities', [\App\Http\Controllers\API\V1\User\HouseAmenityController::class, 'findByHouse']);
            });

            Route::group(['prefix' => 'fee'], function () {
                Route::get('/categories', [\App\Http\Controllers\API\V1\User\FeeCategoryController::class, 'getFeeCategory']);
            });

            Route::apiResource('rooms', \App\Http\Controllers\API\V1\User\RoomController::class);

            Route::apiResource('pricelist', \App\Http\Controllers\API\V1\User\PriceListController::class);

            Route::get('/utilities', [\App\Http\Controllers\API\V1\User\UtilityController::class, 'index'])->name('utilities.index');
        });
    });

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('/upload', [\App\Http\Controllers\API\V1\UploadController::class, 'upload']);
        Route::post('/upload-multiple', [\App\Http\Controllers\API\V1\UploadController::class, 'uploadMultiple']);

    });
});
