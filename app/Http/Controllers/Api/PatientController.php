<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return PatientResource::collection( Patient::orderBy( 'first_name' )->orderBy( 'last_name' )->get() );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PatientRequest $request
     * @return PatientResource
     */
    public function store(PatientRequest $request): PatientResource
    {
        return new PatientResource( Patient::create( $request->validated() ) );

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return PatientResource
     */
    public function show( int $id ): PatientResource
    {
        $patient = Patient::find( $id );

        if ( !$patient ) {
            abort( 404, 'Patient not found' );
        }

        return new PatientResource( $patient );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param PatientRequest $request
     * @param Patient $patient
     * @return PatientResource
     */
    public function update(PatientRequest $request, Patient $patient): PatientResource
    {
        $patient->update( $request->validated() );

        return new PatientResource( $patient );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Patient $patient
     * @return Response
     */
    public function destroy(Patient $patient): Response
    {
        $patient->delete();

        return response()->noContent();

    }

}
