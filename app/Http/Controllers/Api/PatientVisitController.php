<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientVisitRequest;
use App\Http\Resources\PatientVisitResource;
use App\Models\PatientVisit;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PatientVisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return PatientVisitResource::collection( PatientVisit::orderBy( 'visit_date', 'desc' )->get() );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PatientVisitRequest $request
     * @return PatientVisitResource
     */
    public function store(PatientVisitRequest $request): PatientVisitResource
    {
        $patient_visit = auth()->user()->patient_visits()->create([
            'patient_id'    => trim( $request->patient_id ),
            'visit_date'    => trim( $request->visit_date ),
            'symptoms'      => trim( $request->symptoms ),
            'diagnosis'     => trim( $request->diagnosis )
        ]);

        return new PatientVisitResource( $patient_visit );

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return PatientVisitResource
     */
    public function show(int $id)
    {
        $patient_visit = PatientVisit::find( $id );

        if ( !$patient_visit ) {
            abort( 404, 'Patient visit not found' );
        }

        return new PatientVisitResource( $patient_visit );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param PatientVisitRequest $request
     * @param PatientVisit $patientVisit
     * @return PatientVisitResource
     */
    public function update(PatientVisitRequest $request, PatientVisit $patientVisit): PatientVisitResource
    {
        $patientVisit->update( $request->validated() );

        return new PatientVisitResource( $patientVisit );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PatientVisit $patientVisit
     * @return Response
     */
    public function destroy(PatientVisit $patientVisit): Response
    {
        $patientVisit->delete();

        return response()->noContent();

    }

}
