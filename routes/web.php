<?php

use Illuminate\Support\Facades\Auth;
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

Route::middleware( [ 'auth' => 'verified' ] )->group( function () {

});

Route::get( '/users', function () {
    return view( 'users', [
        'charts'        => false,
        'data_tables'   => true,
        'date_picker'   => false,
        'moment'        => false,
        'type_ahead'    => false,
    ]);
})->name( 'users' );

Route::get( '/', function () {
    return view( 'home', [
        'charts'        => true,
        'data_tables'   => false,
        'date_picker'   => false,
        'moment'        => false,
        'type_ahead'    => false,
    ]);
})->name( 'home' );

Route::get( '/patients', function () {
    return view( 'patients', [
        'charts'        => false,
        'data_tables'   => true,
        'date_picker'   => true,
        'moment'        => false,
        'type_ahead'    => false,
    ]);
})->name( 'patients' );

Route::get( '/patient-visits', function () {
    return view( 'patient-visits', [
        'charts'        => false,
        'data_tables'   => true,
        'date_picker'   => true,
        'moment'        => true,
        'type_ahead'    => true,
    ]);
})->name( 'patient-visits' );

Route::get( '/measurement-units', function () {
    return view( 'measurement-units', [
        'charts'        => false,
        'data_tables'   => true,
        'date_picker'   => false,
        'moment'        => false,
        'type_ahead'    => false,
    ]);
})->name( 'measurement-units' );

Route::get( '/medicines', function () {
    return view( 'medicines', [
        'charts'        => false,
        'data_tables'   => true,
        'date_picker'   => true,
        'moment'        => false,
        'type_ahead'    => true,
    ]);
})->name( 'medicines' );

Route::get( '/prescriptions', function () {
    return view( 'prescriptions', [
        'charts'        => false,
        'data_tables'   => true,
        'date_picker'   => true,
        'moment'        => false,
        'type_ahead'    => true,
    ]);
})->name( 'prescriptions' );

Route::get( '/verify', function () {

})->name( 'verification.notice' );

Route::get( '/register', function () {
    return view( 'auth.register' );
})->name( 'register' );
