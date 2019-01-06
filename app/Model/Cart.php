<?php

namespace App\Model;

use App\Model\Guest;
use App\Model\Product;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //protected $primaryKey = "visitor";
    //public $incrementing = false;
    //protected $keyType = string();
	protected $fillable = [
		'guest_id', 'product_id', 'quantity'
	];
    /*===============================================================================
	|
	|	cart will have many products
	*/
	public function products()
	{
		//return $this->belongsToMany(Product::class);//, 'cart_product', 'product_id', 'cart_visitor');
		return $this->hasMany(Product::class);
	}

	public function guest()
	{
		return $this->belongsTo(Guest::class);
	}
}
