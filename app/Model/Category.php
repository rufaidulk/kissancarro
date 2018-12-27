<?php

namespace App\Model;

use App\Model\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /*=============================================================
	|	
	|	each category has many products
	|	category can access the product
	*/
	public function products()
	{
		return $this->hasMany(Product::class);
	}
}
