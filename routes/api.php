<?php

use App\Http\Controllers\Api\BedController;
use App\Http\Controllers\Api\MeasurementUnitController;
use App\Http\Controllers\Api\MedicineController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\PatientVisitController;
use App\Http\Controllers\Api\PrescriptionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WardController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource( '/users', UserController::class );

Route::apiResource( '/patients', PatientController::class );

Route::apiResource( '/measurement-units', MeasurementUnitController::class );

Route::apiResource( '/medicines', MedicineController::class );

Route::apiResource( '/patient-visits', PatientVisitController::class );

Route::apiResource( '/prescriptions', PrescriptionController::class );

Route::apiResource( '/wards', WardController::class );

Route::apiResource( '/beds', BedController::class );
