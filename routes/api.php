<?php

use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\BuildingController;
use App\Http\Controllers\Api\OrganizationController;
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


Route::prefix('organizations')->group(function () {
    Route::get('building/{buildingId}', [OrganizationController::class, 'getOrganizationsInBuilding']);
    Route::get('activity/{activityId}', [OrganizationController::class, 'getOrganizationsByActivity']);
    Route::get('radius', [OrganizationController::class, 'getOrganizationsByRadius']);
    Route::get('{id}', [OrganizationController::class, 'getOrganizationById']);
    Route::get('search', [OrganizationController::class, 'searchOrganizationsByName']);
    Route::get('activity/search/{activityName}', [OrganizationController::class, 'searchOrganizationsByActivityName']);
});

Route::prefix('buildings')->group(function () {
    Route::get('', [BuildingController::class, 'getAllBuildings']);
    Route::get('{id}', [BuildingController::class, 'getBuildingById']);
});

Route::prefix('activities')->group(function () {
    Route::get('', [ActivityController::class, 'getAllActivities']);
    Route::get('parent/{parentId}', [ActivityController::class, 'getActivitiesByParentId']);
});
