<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Model\Order;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderResource;
use App\Http\Resources\Order\OrderCollection;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return OrderCollection::collection($user->orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request, User $user)
    {
        $order = new Order;
        $order->product_id = $request->product_id;
        $order->user_id = $user->id;
        $order->quantity = $request->quantity;
        $order->profile_id = $request->profile_id;
        $order->status = "ongoing";
        $order->save();

        return response([
            'data' => new OrderResource($order)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Order $order)
    {
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Order $order)
    {
        $order->update($request->all());

        return response([
            'data' => new OrderResource($order)
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Order $order)
    {
        $order->delete();

        return response([
            "success" => "Deleted successfully"
        ],Response::HTTP_NO_CONTENT);
    }
}
