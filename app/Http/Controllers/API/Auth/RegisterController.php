<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    /**
     * Register a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // $this->userValidation($request->all());
        // $this->validator($request->all())->validate();

        $validator = Validator::make($request->all(), [
            "firstName" => "required|string|max:255",
            "lastName" => "required|string|max:255",
            "email"    => "required|string|email|unique:users|max:255",
            "password" => "required|string|min:6|max:255|confirmed"
        ]);

        if ($validator->fails()) {
            # code...
            return response(["errors" => $validator->errors()], 422);
        }

        $user = new User();
        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

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
        // return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    /***
     * To validate user data for registration
     */
    // protected function userValidation(Request $request) {
        // $validator = Validator::make($request, [
        //     "firstName" => "required|string|max:255",
        //     "lastName" => "required|string|max:255",
        //     "email"    => "required|string|email|unique:users|max:255",
        //     "password" => "required|string|min:6|max:255|confirmed"
        // ]);

        // if ($validator->fails()) {
        //     # code...
        //     return response(["errors" => $validator->errors()], 422);
        // }

    //     return $validator;
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => ['required', 'string', 'max:255'],
            "firstName" => ['required', 'string', 'max:255'],
            "lastName" => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'mobile' => ['required', 'number', 'min:10'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

}
