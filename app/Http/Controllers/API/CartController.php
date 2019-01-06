<?php

namespace App\Http\Controllers\API;

use App\Model\Cart;
use App\Model\Guest;
use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Http\Resources\Cart\CartResource;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Guest $guest)
    {
        return CartResource::collection($guest->carts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CartRequest $request)
    {
        $cart = new Cart;
        $cart->guest_id = $request->guest_id;
        $cart->product_id = $request->product_id;
        $cart->quantity = $request->quantity;
        $cart->save();
        return response([
            'data' => new CartResource($cart)
        ], Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Guest $guest, Cart $cart)
    {
        return new CartResource($cart);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Guest $guest, Cart $cart)
    {
        $cart->update($request->all());
        return response([
            'data' => new CartResource($cart)
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guest $guest, Cart $cart)
    {
        $cart->delete();
        return response(Response::HTTP_NO_CONTENT);
    }
}
