<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WardRequest;
use App\Http\Resources\WardResource;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class WardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return WardResource::collection( Ward::orderBy( 'name' )->get() );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param WardRequest $request
     * @return WardResource
     */
    public function store(WardRequest $request): WardResource
    {
        return new WardResource( Ward::create( $request->validated() ) );

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return WardResource
     */
    public function show(int $id): WardResource
    {
        $ward = Ward::find( $id );

        if ( !$ward ) {
            abort( 404, 'Ward not found' );
        }

        return new WardResource( $ward );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param WardRequest $request
     * @param Ward $ward
     * @return WardResource
     */
    public function update(WardRequest $request, Ward $ward): WardResource
    {
        $ward->update( $request->validated() );

        return new WardResource( $ward );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Ward $ward
     * @return Response
     */
    public function destroy(Ward $ward): Response
    {
        $ward->delete();

        return response()->noContent();

    }

}
