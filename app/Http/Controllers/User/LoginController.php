<?php

namespace App\Http\Controllers\User;

use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {   
        $user = array();
        $user['username'] = $request->username;

        $this->client_id = $request->client_id;
        $this->client = DB::table('oauth_clients')->where('id', $this->client_id)->first();
        if ($this->client) {
            $request->request->add([
                'grant_type' => $request->grant_type,
                'client_id' => $request->client_id,
                'client_secret' => $this->client->secret,
                'username' => $this->getPhone($user),
                'password' => $request->password,
                'scope' => $request->scope,
            ]);
            $proxy = Request::create(
                'oauth/token',
                'POST'
            );
            return Route::dispatch($proxy);
        }
        return "Wrong Credentials";
    }
    
    /*=================================================================================
    |   if the user log in with the phone, request is replaced with the email 
    |   corresponging to the phone
    */
    protected function getPhone(array $username)
    {
        $validator = Validator::make($username, [
            'username' => 'email',
        ]);

        if ($validator->fails()) {

            if (User::where('phone', $username['username'])->exists()) {

                $user = User::where('phone', $username['username'])->first();
                return $user->email;

            } else {

                return $username['username'];

            }

        } elseif (!$validator->fails()) {

            return $username['username'];

        }
    }
}
