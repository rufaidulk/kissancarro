<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Model\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Profile\ProfileResource;
use App\Http\Resources\Profile\ProfileCollection;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, Profile $profile)
    {
        return ProfileCollection::collection($user->profiles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request, User $user)
    {
        $profile = new Profile;
        $profile->user_id = $user->id;
        $profile->customer_name = $request->customer_name;
        $profile->customer_contact = $request->customer_contact;
        $profile->street = $request->street;
        $profile->city = $request->city;
        $profile->district = $request->district;
        $profile->zipcode = $request->zipcode;
        $profile->landmark = $request->landmark;
        $profile->address_type = $request->address_type;
        $profile->save();

        return response([
            'data' => new ProfileResource($profile)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Profile $profile)
    {
        return new ProfileResource($profile);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Profile $profile)
    {
        $profile->update($request->all());

        return response([
            'data' => new ProfileResource($profile)
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Profile $profile)
    {
        $profile->delete();

        return response([
            "success" => "Deleted successfully"
        ],Response::HTTP_NO_CONTENT);
    }
}
