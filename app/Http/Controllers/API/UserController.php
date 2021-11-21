<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function user() {
        if (Auth::user()) {
            # code...
            return Auth::user();
        }
        // return $user->user();

        // return $this->auth()->guard()->user();
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request) {
        $request->user()->token()->revoke();

        return response("User logout successfully...", 200);
    }


    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    // protected function guard()
    // {
    //     return Auth::guard();
    // }

    public function authFailed() {
        return response('Unauthenticated user', 401);
    }

}
