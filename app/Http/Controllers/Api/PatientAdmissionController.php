<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientAdmissionRequest;
use App\Http\Resources\PatientAdmissionResource;
use App\Models\PatientAdmission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PatientAdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return PatientAdmissionResource::collection( PatientAdmission::with( 'patient' )
            ->orderBy( 'admission_date', 'desc' )->get() );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PatientAdmissionRequest $request
     * @return PatientAdmissionResource
     */
    public function store(PatientAdmissionRequest $request): PatientAdmissionResource
    {
        return new PatientAdmissionResource( PatientAdmission::create( $request->validated() ) );

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return PatientAdmissionResource
     */
    public function show(int $id ): PatientAdmissionResource
    {
        $patientAdmission = PatientAdmission::find( $id );

        if ( !$patientAdmission ) {
            abort( 404, 'Admission record not found' );
        }

        return new PatientAdmissionResource( $patientAdmission );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param PatientAdmissionRequest $request
     * @param PatientAdmission $patientAdmission
     * @return PatientAdmissionResource
     */
    public function update(PatientAdmissionRequest $request, PatientAdmission $patientAdmission): PatientAdmissionResource
    {
        $patientAdmission->update( $request->validated() );

        return new PatientAdmissionResource( $patientAdmission );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PatientAdmission $patientAdmission
     * @return Response
     */
    public function destroy(PatientAdmission $patientAdmission): Response
    {
        $patientAdmission->delete();

        return response()->noContent();

    }

}
