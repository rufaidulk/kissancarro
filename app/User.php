<?php

namespace App;

use App\Model\Order;
use App\Model\Review;
use App\Model\Profile;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*===============================================================================
    |
    |   users may have many profiles. i.e many delivery addressess.
    */
    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }

    /*===============================================================================
    |
    |   users may have many orders
    */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /*===============================================================================
    |
    |   each user may have many reviews on different product
    */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
