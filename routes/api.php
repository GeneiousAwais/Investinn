<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OpportunityController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserTypeController;
use App\Http\Controllers\Api\SectorController;
use App\Http\Controllers\Api\InvestorController;
use \App\Http\Controllers\Api\BlogController;
use \App\Http\Controllers\Api\GlobalAPIController;
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
Route::group(['prefix'=>'auth'], function(){
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});
Route::get('usertypes-get', [UserTypeController::class, 'index']);

Route::get('opportunities-get', [OpportunityController::class, 'index']);
Route::get('opportunity-details/{id}', [OpportunityController::class, 'opportunityDetail']);

Route::get('sectors-get', [SectorController::class, 'index']);

Route::get('investors', [InvestorController::class, 'index']);
Route::get('investor/{id}', [InvestorController::class, 'show']);

Route::get('blogs', [BlogController::class, 'index']);
Route::get('blog/{id}', [BlogController::class, 'show']);
Route::get('get_tags', [BlogController::class, 'get_tags']);

Route::get('get_stats', [GlobalAPIController::class, 'get_stats']);
