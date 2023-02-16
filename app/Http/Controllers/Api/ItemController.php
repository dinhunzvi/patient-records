<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Models\Medicine;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class ItemController extends Controller
{

    public function index(): AnonymousResourceCollection
    {
       return ItemResource::collection( Item::all() );

    }

    /**
     * store resource
     * @param ItemRequest $request
     * @return ItemResource
     */
    public function store( ItemRequest $request): ItemResource
    {
        return new ItemResource( Item::create( $request->validated() ) );

    }

    /**
     * delete resource
     * @param Item $item
     * @return Response
     */
    public function destroy( Item $item): Response
    {
        $item->delete();

        return response()->noContent();

    }

}
