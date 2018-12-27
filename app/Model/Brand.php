<?php

namespace App\Model;

use App\Model\Product;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    /*=============================================================
	|	
	|	brand have many products
	|	brand can access the product
	*/
	public function products()
	{
		return $this->hasMany(Product::class);
	}
}
