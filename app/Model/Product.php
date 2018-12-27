<?php

namespace App\Model;

use App\Model\Cart;
use App\Model\Brand;
use App\Model\Review;
use App\Model\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /*===============================================================================
	|
	|	can access the brand of the product
	*/
	public function brand()
	{
		return $this->belongsTo(Brand::class);
	}

	/*===============================================================================
	|
	|	can access the category of the product
	*/
	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	/*===============================================================================
	|
	|	product have many reviews
	|	can access the all reviews of the product
	*/
	public function reviews()
	{
		return $this->hasMany(Review::class);
	}

	/*===============================================================================
	|
	|	can access the products in the cart
	*/
	public function carts()
	{
		return $this->belongsToMany(Cart::class);
	}
}
