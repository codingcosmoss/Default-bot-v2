<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResources;
use App\Models\Settings\Configuration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(LoginRequest $loginRequest)
    {
        try {

            $user = User::where('login', $loginRequest->input('login'))->first();

            if (!$user){
                return $this->error($this->unAuthorized, "User not fount");

            }

            if (empty($user) || !Hash::check($loginRequest->input('password'), $user->password)) {

                return $this->error($this->unAuthorized, "User not fount");

            }

            $user->token = $user->createToken('laravel-vue-admin')->plainTextToken;

            return $this->success($this->ok, 'User login successful', $user->token);


        }catch (Exception $e){
            return $this->error($this->badRequest, $e->getMessage());
        }

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        auth()->user()->currentAccessToken()->delete();
        return $this->success($this->ok, 'Logout Successful');
    }

    public function user()
    {
        try {
            return $this->success($this->ok, 'Get user successful', new UserResources(auth()->user()));
        }catch (\Exception $e){
            return $this->error($this->badRequest, $e->getMessage());
        }
    }

    public function unauthorized(){
        return $this->error($this->ok, 'Unauthorized user :( ');
    }

    public function test(){
        return $this->error($this->ok, 'Test successfuly :) ');
    }

}
