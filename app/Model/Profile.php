<?php

namespace App\Model;

use App\User;
use App\Model\Order;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{   
    protected $fillable = [
        'user_id', 'customer_name', 'customer_contact', 'street', 'city', 'district', 'zipcode', 'landmark', 'address_type'
    ];
    /*===============================================================================
	|
	|	each profile is belongs to one user
	*/
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	/*===============================================================================
    |
    |   each profile may have many orders. i.e in a single delivery address, there 
    |	be many orders.
    */
    public function orders()
    {
    	return $this->hasMany(Order::class);
    }
}
