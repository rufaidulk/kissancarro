<?php

namespace App\Http\Controllers\API;

use App\Model\Guest;
use Illuminate\Http\Request;
use App\Http\Requests\GuestRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Guest\GuestResource;
use App\Http\Resources\Guest\GuestCollection;
use Symfony\Component\HttpFoundation\Response;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return GuestCollection::collection(Guest::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuestRequest $request)
    {
        $guest = new Guest;
        $guest->IP = $request->IP;
        $guest->save();

        return response([
            'data' => new GuestResource($guest)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function show(Guest $guest)
    {
        return new GuestResource($guest);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guest $guest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guest $guest)
    {
        $guest->delete();

        return response([
            "success" => "Deleted successfully"
        ],Response::HTTP_NO_CONTENT);
    }
}
