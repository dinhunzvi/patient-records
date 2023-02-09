<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BedRequest;
use App\Http\Resources\BedResource;
use App\Models\Bed;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class BedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return BedResource::collection( Bed::with( 'ward' )->orderBy( 'ward_id' )->get() );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BedRequest $request
     * @return BedResource
     */
    public function store(BedRequest $request): BedResource
    {
        return new BedResource( Bed::create( $request->validated() ) );

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return BedResource
     */
    public function show(int $id)
    {
        $bed = Bed::find( $id );

        if ( !$bed ) {
            abort( 404, 'Bed not found' );
        }

        return new BedResource( $bed );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param BedRequest $request
     * @param Bed $bed
     * @return BedResource
     */
    public function update(BedRequest $request, Bed $bed)
    {
        $bed->update( $request->validated() );

        return new BedResource( $bed );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Bed $bed
     * @return Response
     */
    public function destroy(Bed $bed): Response
    {
        $bed->delete();

        return response()->noContent();

    }

    /**
     * search for beds
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function search( Request $request): AnonymousResourceCollection
    {
        $name = trim( $request->get( 'name' ) );

        return BedResource::collection( Bed::where( 'name', 'like', "%{$name}%" )->get() );

    }

}
