<?php

namespace App;

use App\OTP;
use App\Model\Order;
use App\Model\Review;
use App\Model\Profile;
use App\Mail\RegistrationOTPMail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\OTPNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    //public $id;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password',
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

    public function getOTP($id, $key)
    {
        $OTP = rand(100000, 999999);
        $otp = new OTP();
        $otp->user_id = $id;
        $otp->otp = $OTP;
        $otp->key = $key;
        $otp->save();

        return $OTP;
    }

    public function sendOTP($id, $key, $purpose)
    {
        //Mail::to($request->email)->send(new RegistrationOTPMail($this->getOTP($id, $request->password)));
        $this->notify(new OTPNotification($this->getOTP($id, $key), $purpose));
    }

    public function routeNotificationForKarix()
    {
        return $this->phone;
    }
}
