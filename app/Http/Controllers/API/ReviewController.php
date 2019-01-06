<?php

namespace App\Http\Controllers\API;

use App\Model\Review;
use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use Symfony\Component\HttpFoundation\Response;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        /*=======================================================
        |   
        |   collection() is used since more than one reviews
        |   bcoz of the model relationship
        */
        return ReviewResource::collection($product->reviews); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request, Product $product)
    {
        $review = new Review;
        $review->product_id = $request->product_id;
        $review->user_id = $request->user_id;
        $review->review = $request->review;
        $review->star = $request->star;
        $review->save();

        return response([
            'data' => new ReviewResource($review)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, Review $review)
    {
        return new ReviewResource($review);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, Review $review)
    {
        $review->update($request->all());

        return response([
            'data' => new ReviewResource($review)
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Review $review)
    {
        $review->delete();

        return response([
            "success" => "Deleted successfully"
        ],Response::HTTP_NO_CONTENT);
    }
}
