<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VisitRequest;
use App\Http\Resources\VisitResource;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return VisitResource::collection( Visit::all() );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VisitRequest $request
     * @return VisitResource
     */
    public function store(VisitRequest $request): VisitResource
    {
        return new VisitResource( Visit::create( $request->validated() ) );

    }

    /**
     * Display the specified resource.
     *
     * @param Visit $visit
     * @return Response
     */
    public function show(Visit $visit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VisitRequest $request
     * @param Visit $visit
     * @return VisitResource
     */
    public function update(VisitRequest $request, Visit $visit): VisitResource
    {
        $visit->update( $request->validated() );

        return new VisitResource( $visit );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Visit $visit
     * @return Response
     */
    public function destroy(Visit $visit): Response
    {
        $visit->delete();

        return response()->noContent();

    }

}
