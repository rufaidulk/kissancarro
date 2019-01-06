<?php

namespace App\Model;

use App\User;
use App\Model\Profile;
use App\Model\Payment;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{   
    protected $fillable = [
        'product_id', 'user_id', 'quantity', 'profile_id', 'status'
    ];
    /*===============================================================================
    |
    |   each order have only one user. i.e every order have a unique user
    */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    /*===============================================================================
    |
    |   order will have only one profile. i.e one delivery address
    */
    public function profile()
    {
    	return $this->belongsTo(Profile::class);
    }

    /*===============================================================================
    |
    |   each order will have only one payment
    */
    public function payment()
    {
    	return $this->hasOne(Payment::class);
    }
}
