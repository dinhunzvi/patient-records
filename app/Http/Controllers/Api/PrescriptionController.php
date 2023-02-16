<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PrescriptionRequest;
use App\Http\Resources\PrescriptionResource;
use App\Models\Item;
use App\Models\Prescription;
use App\Models\PrescriptionItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return PrescriptionResource::collection( Prescription::with( 'patient' )->get() );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PrescriptionRequest $request
     * @return PrescriptionResource
     */
    public function store(PrescriptionRequest $request): PrescriptionResource
    {
        $prescription = Prescription::create( $request->validated() );

        foreach ( Item::all() as $item ) {
            $prescription_item = new PrescriptionItem;

            $prescription_item->prescription_id = $prescription->id;
            $prescription_item->medicine_id = $item->medicine_id;
            $prescription_item->quantity = $item->quantity;
            $prescription_item->dosage = $item->dosage;

            $prescription_item->save();

            $item->delete();

        }

        return new PrescriptionResource( $prescription );

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return PrescriptionResource
     */
    public function show(int $id ): PrescriptionResource
    {
        $prescription = Prescription::find( $id );

        if ( !$prescription ) {
            abort( 404, 'Prescription not found' );
        }

        return new PrescriptionResource( $prescription );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param PrescriptionRequest $request
     * @param Prescription $prescription
     * @return PrescriptionResource
     */
    public function update(PrescriptionRequest $request, Prescription $prescription): PrescriptionResource
    {
        $prescription->update( $request->validated() );

        return new PrescriptionResource( $prescription );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Prescription $prescription
     * @return Response
     */
    public function destroy(Prescription $prescription): Response
    {
        $prescription->delete();

        return response()->noContent();

    }

}
