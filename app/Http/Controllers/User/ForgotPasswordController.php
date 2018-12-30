<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    protected $OTP;
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
     * Send a reset OTP to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetOTP(Request $request)
    {
        $this->validatePhone($request);
        $userId = $this->getUserId($request->phone);
        $user = new User();
        $user->sendOTP($userId, "xxxxxxx", "password reset");

        return response([
            'success' => 'User OTP sent successfully!',
            'user_id' => $userId,
        ], Response::HTTP_CREATED);
    }

    /**
     * Validate the phone for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validatePhone(Request $request)
    {
        $request->validate(['phone' => 'required|numeric|exists:users,phone']);
    }

    protected function getUserId($phone)
    {
        $user = User::where('phone', $phone)->first();
        return $user->id;
    }

    public function verify(Request $request)
    {
        $this->OTP = DB::table('o_t_ps')->where('user_id', $request->user_id)->first();

        if ($this->OTP->otp == $request->otp) {

            if ($request->newPassword == $request->newPasswordConfirmation) {

                $user = User::where('id', $request->user_id)->first();
                $user->password = Hash::make($request->newPassword);
                $user->save();

                DB::table('o_t_ps')
                            ->where('user_id', $request->user_id)
                            ->delete();

                return response([
                    'success' => 'Password reset success',
                ], Response::HTTP_CREATED);

            } else {

                return response([
                    'warning' => 'Password does not match',
                ], Response::HTTP_CREATED);

            }
            
        } else {

            return response([
                'warning' => 'Invalid OTP or Expired OTP',
            ], Response::HTTP_CREATED);

        }
    }

}
