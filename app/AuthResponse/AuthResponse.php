<?php

namespace App\AuthResponse;


use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Input;

use Session;

class AuthResponse extends AuthResponse
{
    public function sendAuthResponse(User $user) {
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

