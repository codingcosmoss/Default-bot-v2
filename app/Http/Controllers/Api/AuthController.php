<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthUserResource;
use App\Http\Resources\OneUserResource;
use App\Http\Resources\UserResources;
use App\Models\Clinic;
use App\Models\ClinicUser;
use App\Models\Settings\Configuration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                return $this->error($this->unAuthorized, "User not fount ");

            }

            if (empty($user) || !Hash::check($loginRequest->input('password'), $user->password)) {

                return $this->error($this->unAuthorized, "User not fount ");

            }

            $user->token = $user->createToken('laravel-vue-admin')->plainTextToken;

            $data = [
                'user' => new AuthUserResource($user),
                'token' =>  $user->token
            ];

            return $this->success($this->ok, 'User login successful', $data);


        }catch (Exception $e){
            return $this->error($this->badRequest, $e->getMessage());
        }

    }

    public function clinicLogin(LoginRequest $loginRequest)
    {
        try {

            $user = ClinicUser::where('login', $loginRequest->input('login'))->first();

            if (!$user){
                return $this->error($this->unAuthorized, "User not fount");

            }

            if (empty($user) || !Hash::check($loginRequest->input('password'), $user->password)) {

                return $this->error($this->unAuthorized, "User not fount");

            }

            $user->token = $user->createToken('laravel-vue-admin')->plainTextToken;

            $data = [
                'user' => new UserResources($user),
                'token' =>  $user->token
            ];

            return $this->success($this->ok, 'User login successful', $data);


        }catch (Exception $e){
            return $this->error($this->badRequest, $e->getMessage());
        }

    }

    public function register(LoginRequest $request)
    {
        try {

            $isUsername = User::where('login', $request->login )->first();
            if ($isUsername){
                return $this->success($this->badRequest, 'bunday login avvaldan mavjud');
            }

            DB::beginTransaction();
            $isSaved = true;
            $user = new User();
            $user->name = $request->name;
            $user->login = $request->login;
            $user->password = $request->password;
            $user->save();

            $clinic = new Clinic();


            $user->token = $user->createToken('laravel-vue-admin')->plainTextToken;
            $data = [
                'user' => new UserResources($user),
                'token' =>  $user->token
            ];

            return $this->success($this->ok, 'User login successful', $data);


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
            return $this->success($this->ok, 'Get user successful', new AuthUserResource(auth()->user()));
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
