<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeoLocationController;
use App\Http\Controllers\ApiKeyController;
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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/generate-api-key', [ApiKeyController::class, 'generate']);
Route::get('/users', [ApiKeyController::class, 'read']);

Route::middleware('api_token')->group(function () {
    Route::get('/ip-details', [GeoLocationController::class, 'getIPDetails']);
});