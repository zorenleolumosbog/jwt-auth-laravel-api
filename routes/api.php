<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use LaravelJsonApi\Laravel\Facades\JsonApiRoute;
use LaravelJsonApi\Laravel\Http\Controllers\JsonApiController;

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

/**
 * Unauthenticated API
 */
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function() {
    // Route::apiResource('users', UserController::class);

    Route::post('users/login', ['uses' => 'AuthController@login']);
    Route::post('users/register', ['uses' => 'AuthController@register']);
    Route::post('users/forgot-password', ['uses' => 'NewPasswordController@forgotPassword'])->name('password.reset');
    Route::post('users/reset-password', ['uses' => 'NewPasswordController@resetPassword']);
});

/**
 * Authenticated API
 */
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'middleware' => 'auth'], function() {
    Route::post('users/refresh-token', ['uses' => 'AuthController@refresh']);
    Route::post('users/logout', ['uses' => 'AuthController@logout']);
    Route::post('users/email/verification-notification', ['uses' => 'EmailVerificationController@sendVerificationEmail']);
    Route::get('users/verify-email/{id}/{hash}', ['uses' => 'EmailVerificationController@verify'])->name('verification.verify');
});

Route::group(['middleware' => 'auth'], function() {
    JsonApiRoute::server('v1')->prefix('v1')->resources(function ($server) {
        $server->resource('users', JsonApiController::class)
                ->only('index', 'show', 'store', 'update')
                ->relationships(function ($relations) {
                    $relations->hasOne('registrant');
                });
        $server->resource('registrants', JsonApiController::class)
                ->relationships(function ($relations) {
                    $relations->hasOne('user');
                });
    });
});
