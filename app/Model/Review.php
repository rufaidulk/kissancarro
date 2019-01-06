<?php

namespace App\Model;

use App\User;
use App\Model\Product;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{	
	protected $fillable = [
		'product_id', 'user_id', 'review', 'star'
	];
    /*===============================================================================
	|
	|	can access the parent product of the each reviews
	*/
	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	/*===============================================================================
	|
	|	each review is belongs to particular user
	*/
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
