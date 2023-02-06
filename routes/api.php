<?php

use App\Http\Controllers\Api\BedController;
use App\Http\Controllers\Api\MeasurementUnitController;
use App\Http\Controllers\Api\MedicineController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\PrescriptionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VisitController;
use App\Http\Controllers\Api\WardController;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

Route::apiResource( '/visits', VisitController::class );

Route::apiResource( '/prescriptions', PrescriptionController::class );

Route::apiResource( '/wards', WardController::class );

Route::apiResource( '/beds', BedController::class );

Route::post( '/measurement-units/search', [ MeasurementUnitController::class, 'search' ] );

Route::post( '/patients/search', [ PatientController::class, 'search' ] );

Route::post( '/wards/search', [ WardController::class, 'search' ] );

/**
 * get patient visits by month
 */
Route::get( '/patient-visits-by-month', function () {
    $patient_visits = Visit::select( DB::raw( "count( * ) as patient_visits" ),
        DB::raw( "concat_ws( '-', monthname( visit_date ), year( visit_date ) ) as visit_month" ) )
        // ->groupBy( "concat_ws( '-', monthname( visit_date ), year( visit_date ) )" )
        ->groupBy( "visit_month" )
        ->get();

    return response()->json([
        'patient_visits'    => $patient_visits
    ]);

});
