<?php

namespace App\Http\Controllers\Auth;

use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class AuthenticationController extends Controller
{
    use Helpers;
    protected $auth;

    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = $this->auth->attempt($credentials)) {
                $this->response->errorUnauthorized('invalid_credentials');
            }
        } catch (JWTException $e) {
            $this->response->errorInternal('could_not_create_token');
        }
        return response()->json(compact('token'));
    }
}