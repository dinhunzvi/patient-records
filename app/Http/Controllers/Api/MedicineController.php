<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicineRequest;
use App\Http\Resources\MedicineResource;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return MedicineResource::collection( Medicine::with( 'measurement_unit' )->get() );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MedicineRequest $request
     * @return MedicineResource
     */
    public function store(MedicineRequest $request): MedicineResource
    {
        return new MedicineResource( Medicine::create( $request->validated() ) );

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return MedicineResource
     */
    public function show(int $id ): MedicineResource
    {
        $medicine = Medicine::find( $id );

        if ( !$medicine ) {
            abort( 404, 'Medicine not found' );
        }

        return new MedicineResource( $medicine );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param MedicineRequest $request
     * @param Medicine $medicine
     * @return MedicineResource
     */
    public function update(MedicineRequest $request, Medicine $medicine): MedicineResource
    {
        $medicine->update( $request->validated() );

        return new MedicineResource( $medicine );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Medicine $medicine
     * @return Response
     */
    public function destroy(Medicine $medicine): Response
    {
        $medicine->delete();

        return response()->noContent();

    }

    /**
     * search for medicines using name
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function search( Request $request): AnonymousResourceCollection
    {
        $name = trim( $request->name );

        return MedicineResource::collection( Medicine::where( 'name', 'like', "%{$name}%" )->get() );

    }

}
