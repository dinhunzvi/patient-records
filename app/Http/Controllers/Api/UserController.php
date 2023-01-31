<?php

namespace App\Http\Controllers\Api;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection( User::orderBy( 'name' )->get() );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @param CreateNewUser $action
     * @return RedirectResponse
     */
    public function store(UserRequest $request, CreateNewUser $action ): RedirectResponse
    {
        $action->create($request->validated() );

        return redirect()
            ->route('users')
            ->with('success', 'User created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return UserResource
     */
    public function show(int $id): UserResource
    {
        $user = User::find( $id );

        if ( !$user ) {
            abort( 404, 'User not found' );
        }

        return new UserResource( $user );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return UserResource
     */
    public function update(UserRequest $request, User $user): UserResource
    {
        $user->update( $request->validated() );

        return new UserResource( $user );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     */
    public function destroy(User $user): Response
    {
        $user->delete();

        return response()->noContent();

    }

}
