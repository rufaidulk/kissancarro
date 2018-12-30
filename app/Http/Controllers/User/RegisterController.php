<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    private $client;
    private $client_id;
    private $OTP;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        $this->guard()->login($user);
        if (auth()->user()) {
           auth()->user()->sendOTP($user->id, $request->password, "registration");
        }
        return response([
            'success' => 'User OTP sent successfully!',
            'user_id' => $user->id,
        ], Response::HTTP_CREATED);
    }
    
    public function verify(Request $request)
    {
        $this->OTP = DB::table('o_t_ps')->where('user_id', $request->user_id)->first();
        if ($this->OTP->otp == $request->otp) {
            $user = User::where('id', $request->user_id)->firstOrFail();
            $user->isVerified = true;
            $user->save();

            $this->client_id = $request->client_id;
            $this->client = DB::table('oauth_clients')->where('id', $this->client_id)->first();
            if ($this->client) {
                $request->request->add([
                    'grant_type' => $request->grant_type,
                    'client_id' => $request->client_id,
                    'client_secret' => $this->client->secret,
                    'username' => $user->email,
                    'password' => $this->OTP->key,
                    'scope' => $request->scope,
                ]);
                $proxy = Request::create(
                    'oauth/token',
                    'POST'
                );
                $result = Route::dispatch($proxy);
                if ($result) {
                    DB::table('o_t_ps')
                            ->where('user_id', $this->OTP->user_id)
                            ->delete();
                    return $result;
                }
            }
            return "Wrong Credentials";
        }
    }
    /*
    public function issueToken(Request $request)      
    {
        $this->client_id = $request->client_id;
        $this->client = DB::table('oauth_clients')->where('id', $this->client_id)->first();
        if ($this->client) {
            $request->request->add([
                'grant_type' => $request->grant_type,
                'client_id' => $request->client_id,
                'client_secret' => $this->client->secret,
                'username' => $request->username,
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
    }*/
}
