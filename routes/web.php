<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware( 'auth')->group( function () {

});

Route::get( '/users', function () {
    return view( 'users', [
        'charts'        => false,
        'data_tables'   => true,
        'date_picker'   => false,
        'moment'        => false,
        'type_ahead'    => false,
    ]);
})->name( 'users' )->middleware( 'auth' );

Route::get( '/', function () {
    return view( 'home', [
        'charts'        => true,
        'data_tables'   => false,
        'date_picker'   => false,
        'moment'        => false,
        'type_ahead'    => false,
    ]);
})->name( 'home' )->middleware( 'auth' );

Route::get( '/patients', function () {
    return view( 'patients', [
        'charts'        => false,
        'data_tables'   => true,
        'date_picker'   => true,
        'moment'        => false,
        'type_ahead'    => false,
    ]);
})->name( 'patients' )->middleware( 'auth' );

Route::get( '/patient-visits', function () {
    return view( 'patient-visits', [
        'charts'        => false,
        'data_tables'   => true,
        'date_picker'   => true,
        'moment'        => true,
        'type_ahead'    => true,
    ]);
})->name( 'patient-visits' )->middleware( 'auth' );

Route::get( '/measurement-units', function () {
    return view( 'measurement-units', [
        'charts'        => false,
        'data_tables'   => true,
        'date_picker'   => false,
        'moment'        => false,
        'type_ahead'    => false,
    ]);
})->name( 'measurement-units' )->middleware( 'auth' );

Route::get( '/medicines', function () {
    return view( 'medicines', [
        'charts'        => false,
        'data_tables'   => true,
        'date_picker'   => true,
        'moment'        => false,
        'type_ahead'    => true,
    ]);
})->name( 'medicines' )->middleware( 'auth' );

Route::get( '/prescriptions', function () {
    return view( 'prescriptions', [
        'charts'        => false,
        'data_tables'   => true,
        'date_picker'   => true,
        'moment'        => true,
        'type_ahead'    => true,
    ]);
})->name( 'prescriptions' )->middleware( 'auth' );

Route::get( '/wards', function () {
    return view( 'wards', [
        'charts'        => false,
        'data_tables'   => true,
        'date_picker'   => false,
        'moment'        => false,
        'type_ahead'    => false,
    ]);
})->name( 'wards' )->middleware( 'auth' );

Route::get( '/beds', function () {
    return view( 'beds', [
        'charts'        => false,
        'data_tables'   => true,
        'date_picker'   => false,
        'moment'        => false,
        'type_ahead'    => true,
    ]);
})->name( 'beds' )->middleware( 'auth' );

Route::get( '/patient-admissions', function () {
    return view( 'patient-admissions', [
        'charts'        => false,
        'data_tables'   => true,
        'date_picker'   => true,
        'moment'        => true,
        'type_ahead'    => true,
    ]);
})->name( 'patient-admissions' )->middleware( 'auth' );

/*Route::get( '/verify', function () {

})->name( 'verification.notice' );*/

Route::get( '/register', function () {
    return view( 'auth.register' );
})->name( 'register' );


