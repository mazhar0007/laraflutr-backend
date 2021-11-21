<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Foundation\Auth\ThrottlesLogins;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    // use ThrottlesLogins;
    /**
     * login user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "email"    => "required|string|email|max:255",
            "password" => "required|string"
        ]);

        if ($validator->fails()) {
            # code...
            return response(["errors" => $validator->errors()], 422);
        }

        $credentials = \request(['email', 'password']);

        if (Auth::attempt($credentials)) {
            # code...
            $user = $this->guard()->user();
            //Create Token
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();

            return response([
                'accessToken' => $tokenResult->accessToken,
                'tokenType' => "Bearer",
                'expiresAt' => Carbon::parse($token->expires_at)->toDateTimeString()
            ], 200);
        }

    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request) {
        $this->guard()->user()->token()->revoke();

        return response("User logout successfully...");
    }


    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
