<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MeasurementUnitRequest;
use App\Http\Resources\MeasurementUnitResource;
use App\Models\MeasurementUnit;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class MeasurementUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return MeasurementUnitResource::collection( MeasurementUnit::all() );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MeasurementUnitRequest $request
     * @return MeasurementUnitResource
     */
    public function store(MeasurementUnitRequest $request): MeasurementUnitResource
    {
        return new MeasurementUnitResource( $request->validated() );

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return MeasurementUnitResource
     */
    public function show(int $id ): MeasurementUnitResource
    {
        $measurement_unit = MeasurementUnit::find( $id );

        if ( !$measurement_unit ) {
            abort( 404, 'Measurement unit not found' );
        }

        return new MeasurementUnitResource( $measurement_unit );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param MeasurementUnitRequest $request
     * @param MeasurementUnit $measurementUnit
     * @return MeasurementUnitResource
     */
    public function update(MeasurementUnitRequest $request, MeasurementUnit $measurementUnit): MeasurementUnitResource
    {
        $measurementUnit->update( $request->validated() );

        return new MeasurementUnitResource( $measurementUnit );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MeasurementUnit $measurementUnit
     * @return Response
     */
    public function destroy(MeasurementUnit $measurementUnit): Response
    {
        $measurementUnit->delete();

        return response()->noContent();

    }

}
