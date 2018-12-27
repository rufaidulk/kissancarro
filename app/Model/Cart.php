<?php

namespace App\Model;

use App\Model\Product;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $primaryKey = "visitor";
    public $incrementing = false;
    //protected $keyType = string();

    /*===============================================================================
	|
	|	cart will have many products
	*/
	public function products()
	{
		return $this->belongsToMany(Product::class);//, 'cart_product', 'product_id', 'cart_visitor');
	}
}
