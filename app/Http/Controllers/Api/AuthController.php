<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthUserResource;
use App\Http\Resources\OneUserResource;
use App\Http\Resources\UserResources;
use App\Models\BoxSize;
use App\Models\Clinic;
use App\Models\ClinicUser;
use App\Models\Currency;
use App\Models\DrugCompany;
use App\Models\MedicineCategory;
use App\Models\Menu;
use App\Models\PaymentType;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\Setting;
use App\Models\Settings\Configuration;
use App\Models\SizeType;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Warehouse;
use App\Traits\Status;
use Database\Seeders\DefaultBaseSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;


/**

     * Author: Muhammadali

     * Auth Controller performs the function of user login and registration

 **/

class AuthController extends Controller
{
    /**
     * Handle user login.
     *
     * @param LoginRequest $loginRequest
     * @return JsonResponse
     */
    public function login(LoginRequest $loginRequest)
    {
        try {
            $user = User::where('login', $loginRequest->input('login'))->first();
            if (!$user){
                return $this->error($this->unAuthorized, "User not found");
            }

            if (empty($user) || !Hash::check($loginRequest->input('password'), $user->password)) {
                return $this->error($this->unAuthorized, "User not found");
            }

            $user->token = $user->createToken('laravel-vue-admin')->plainTextToken;

            $data = [
                'user' => new AuthUserResource($user),
                'token' => $user->token
            ];

            return $this->success($this->ok, 'User login successful', $data);

        } catch (Exception $e) {
            return $this->error($this->badRequest, $e->getMessage());
        }
    }

    /**
     * Handle clinic user login.
     *
     * @param LoginRequest $loginRequest
     * @return JsonResponse
     */
    public function clinicLogin(LoginRequest $loginRequest)
    {
        try {
            $user = ClinicUser::where('login', $loginRequest->input('login'))->first();

            if (!$user){
                return $this->error($this->unAuthorized, "User not found");
            }

            if (empty($user) || !Hash::check($loginRequest->input('password'), $user->password)) {
                return $this->error($this->unAuthorized, "User not found");
            }

            $user->token = $user->createToken('laravel-vue-admin')->plainTextToken;

            $data = [
                'user' => new UserResources($user),
                'token' => $user->token
            ];

            return $this->success($this->ok, 'User login successful', $data);

        } catch (Exception $e) {
            return $this->error($this->badRequest, $e->getMessage());
        }
    }

    /**
     * Register a new user and create associated clinic data.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function register(LoginRequest $request)
    {
        try {
            $isUsername = User::where('login', $request->login )->first();
            if ($isUsername){
                return $this->success(203, 'This login already exists');
            }

            DB::beginTransaction();
            $isSaved = true;

            $clinic = new Clinic();
            $clinic->name = isset($request->name) ? $request->name : 'Pharma Plus';
            $clinic->save() != true ? $isSaved = false : '';

            $user = new User();
            $user->name = 'Super Admin';
            $user->clinic_id = $clinic->id;
            $user->login = $request->login;
            $user->phone = +999;
            $user->private = Status::$status_active;
            $user->password = $request->password;
            $user->save() != true ? $isSaved = false : '';

            $user->token = $user->createToken('laravel-vue-admin')->plainTextToken;
            $data = [
                'user' => new AuthUserResource($user),
                'token' => $user->token
            ];

            $this->defaultRole($clinic->id);
            // Run role seeder to assign roles
            Artisan::call('db:seed', [
                '--class' => DefaultBaseSeeder::class,
                '--force' => true
            ]);
            $this->defaultData($clinic);

            if ($isSaved){
                DB::commit();
                return $this->success($this->ok, 'User login successful', $data);
            } else {
                DB::rollBack();
            }

        } catch (Exception $e) {
            return $this->error($this->badRequest, $e->getMessage());
        }
    }

    /**
     * Create default data for a newly created clinic.
     *
     * @param Clinic $clinic
     * @return void
     */
    public function defaultData($clinic)
    {
        MedicineCategory::create([
            'name' => 'General',
            'clinic_id' => $clinic->id,
        ]);

        DrugCompany::create([
            'name' => 'Sanofi',
            'clinic_id' => $clinic->id,
        ]);

        SizeType::create([
            'name' => '100ml',
            'clinic_id' => $clinic->id,
        ]);

        BoxSize::create([
            'name' => '100ml',
            'size' => 100,
            'sign' => 'ml',
            'clinic_id' => $clinic->id,
        ]);

        Warehouse::create([
            'name' => 'Main',
            'clinic_id' => $clinic->id,
        ]);

        Supplier::create([
            'name' => 'Jon',
            'address' => 'London',
            'phone' => '+(998) 993645621',
            'clinic_id' => $clinic->id,
        ]);

        PaymentType::create([
            'name' => 'Cash payment',
            'clinic_id' => $clinic->id,
            'status' => Status::$default
        ]);

        PaymentType::create([
            'name' => 'Paypal',
            'clinic_id' => $clinic->id,
        ]);

        Setting::create([
            'name' => $clinic->name,
            'address' => '---',
            'phone' => '---',
            'currency_id' => Currency::first()->id,
            'clinic_id' => $clinic->id,
        ]);
    }

    public function defaultRole($clinic_id)
    {
        $isRole = Role::where('clinic_id', $clinic_id)->where('private', Status::$status_active)->first();
        $allPermissions = Permission::all()->pluck('id')->toArray();
        if (!$isRole){
            // new Super admin role
            $role = new Role();
            $role->name = 'Super private admin';
            $role->clinic_id = $clinic_id;
            $role->private = Status::$status_active;
            $role->save();

            foreach ($allPermissions as $permission){
                $modelPermission = Permission::find($permission);
                $menu = Menu::find($modelPermission->menu_id);
                if ($menu){
                    $model = new RolePermission();
                    $model->role_id = $role->id;
                    $model->permission_id = $permission;
                    $model->permission_name = $menu->name.'-'.$modelPermission->name;
                    $model->save();
                }
            }
        }
        $defaultRole = new Role();
        $defaultRole->name = 'Admin';
        $defaultRole->clinic_id = $clinic_id;
        $defaultRole->save();

        foreach ($allPermissions as $permission){
            $modelPermission = Permission::find($permission);
            $menu = Menu::find($modelPermission->menu_id);
            if ($menu){
                $model = new RolePermission();
                $model->role_id = $defaultRole->id;
                $model->permission_id = $permission;
                $model->permission_name = $menu->name.'-'.$modelPermission->name;
                $model->save();
            }
        }
    }

    /**
     * Logout the current user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        auth()->user()->currentAccessToken()->delete();
        return $this->success($this->ok, 'Logout Successful');
    }

    /**
     * Get the current authenticated user.
     *
     * @return JsonResponse
     */
    public function user()
    {
        try {
            return $this->success($this->ok, 'Get user successful', new AuthUserResource(auth()->user()));
        } catch (\Exception $e) {
            return $this->error($this->badRequest, $e->getMessage());
        }
    }

    /**
     * Handle unauthorized access.
     *
     * @return JsonResponse
     */
    public function unauthorized()
    {
        return $this->error($this->ok, 'Unauthorized user :( ');
    }

    /**
     * Test method for debugging.
     *
     * @return JsonResponse
     */
    public function test()
    {
        return $this->error($this->ok, 'Test successful :) ');
    }

    public function resetPassword()
    {
        // Komandani ishga tushirish
        Artisan::call('password:reset');

        // Konsol chiqishini olish
        $output = Artisan::output();

        // Xabarni ko'rsatish
        return response()->json([
            'status' => true,
            'message' => 'Password reset command executed successfully.',
            'output' => $output,
        ]);
    }
}

