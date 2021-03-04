<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\API\JsonResponseController as JsonResponseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends JsonResponseController
{
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required'
        ]);
        
        if ($validate->fails()) return $this->errorResponse('Login Failed', [$validate->errors()->all()], 422);
        
        $user = User::whereEmail($request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $success['token'] =  $user->createToken('MyApp')-> accessToken; 
                $success['name'] =  $user->name;

                return $this->successResponse($success, 'Login successfully.');
            } else return $this->errorResponse('Login Failed', ['Password mismatched.'], 422);
        } else  return $this->errorResponse('Login Failed', ['Email not found!'], 404);
    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();

        return $this->successResponse('', 'You have been successfully logged out.');
    }
}