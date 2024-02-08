<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResources;
use App\Models\User;
use App\Traits\Status;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeesService extends AbstractService
{
    /**
     * @var string
     */
    protected $model = User::class;

    /**
     * @var
     */
    protected $user;

    //<editor-fold desc="create">

    /**
     * @return mixed
     */
    public function index()
    {
        $items = $this->model::where('status', Status::$status_active)
            ->orderBy('sort_order', 'asc')
            ->paginate(20);

        $data = [
            'employees' => UserResources::collection($items),
            'pagination' => [
                'total' => $items->total(),
                'per_page' => $items->perPage(),
                'current_page' => $items->currentPage(),
                'last_page' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem(),
            ],
        ];

        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
            'data' => $data
        ];
    }



    /**
     * @param array $data
     * @return JsonResponse|mixed
     */
    public function store(array $data)
    {
        $fields = $this->getFields();

        $rules = [];

        foreach ($fields as $field) {

            $rules[$field->getName()] = $field->getRules();
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {

            $errors = [];

            foreach ($validator->errors()->getMessages() as $key => $value) {

                $errors[$key] = $value[0];
            }

            return [
                'status' => false,
                'message' => 'Validation error',
                'statusCode' => 200,
                'data' => $errors
            ];
        }

        $data = $validator->validated();


        DB::beginTransaction();
        try {
            $user = new $this->model;
            $user->name = $data['name'];
            $user->position = $data['position'];
            $user->login = $data['login'];
            $user->color = $data['color'];
            $user->password = Hash::make($data['password']);
            $user->profil_photo_path = $data['profil_photo_path'];
            $user->percent_salary = $data['percent_salary'];
            $user->salary_static = $data['salary_static'];
            $user->sort_order = $data['sort_order'];
            $user->status = Status::$status_active;

            if ($user->save()) {
                DB::commit();
            } else {
                DB::rollback();
                return [
                    'status' => false,
                    'message' => 'save user error',
                    'statusCode' => 200,
                    'data' => null
                ];
            }

        } catch (\Exception $ex) {
            DB::rollback();
            return [
                'status' => false,
                'message' => 'Server error',
                'statusCode' => 200,
                'data' => $ex->getMessage()
            ];
        }


        return [
            'status' => true,
            'message' => 'success',
            'statusCode' => 200,
            'data' => null
        ];
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return [
            TextField::make('name')->setRules('required|min:3|max:255'),
            TextField::make('position')->setRules('required|min:3|max:255'),
            TextField::make('login')->setRules('required|min:5|max:1024'),
            TextField::make('color')->setRules('nullable'),
            TextField::make('password')->setRules('required|min:5|max:1024'),
            TextField::make('profil_photo_path')->setRules('nullable'),
            TextField::make('percent_salary')->setRules('required|integer'),
            TextField::make('salary_static')->setRules('required|integer'),
            TextField::make('sort_order')->setRules('required|integer'),
        ];
    }

    /**
     * @param array $data
     * @return array|void
     */
    public function checkUserName(array $data)
    {
        $user = User::where(['username' => $data['username']])
            ->first();

        if ($user) {
            return [
                'status' => false,
                'message' => "This username  has already been taken",
                'statusCode' => 403,
                'data' => null
            ];
        }
    }
    //</editor-fold>


    //<editor-fold desc="Edit">
    /**
     * @param array $data
     * @param $id
     * @return JsonResponse|mixed
     */
    public function update(array $data, $id)
    {

        $item = $this->model::where('status', Status::$status_active)
            ->where('id', $id)
            ->first();

        if (!$item) {
            return [
                'status' => false,
                'message' => "User deleted ",
                'statusCode' => 404,
                'data' => null
            ];

        }

//        if ($item->role != User::$role_doctor) {
//            return [
//                'status' => false,
//                'message' => "Siz noto'g'ri apiga ma'lumot yuboryabsiz!",
//                'statusCode' => 403,
//                'data' => null
//            ];
//        }

        $fields = $this->getUpdateFields();

        $rules = [];

        foreach ($fields as $field) {

            $rules[$field->getName()] = $field->getRules();
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {

            $errors = [];

            foreach ($validator->errors()->getMessages() as $key => $value) {

                $errors[$key] = $value[0];
            }

            return [
                'status' => false,
                'message' => 'Validation error',
                'statusCode' => 403,
                'data' => $errors
            ];
        }

        DB::beginTransaction();
        try {

            $item->name = $data['name'];
            $item->position = $data['position'];
            $item->login = $data['login'];
            $item->color = $data['color'];
//            $item->profil_photo_path = $data['profil_photo_path'] ;
            $item->percent_salary = $data['percent_salary'];
            $item->salary_static = $data['salary_static'];
            $item->sort_order = $data['sort_order'];
            $item->status = Status::$status_active;

            if ($item->save()) {
                DB::commit();
            } else {
                DB::rollback();
                return [
                    'status' => false,
                    'message' => 'save user error',
                    'statusCode' => 500,
                    'data' => null
                ];
            }

        } catch (\Exception $ex) {
            DB::rollback();
            return [
                'status' => false,
                'message' => 'Server error',
                'statusCode' => 500,
                'data' => $ex->getMessage()
            ];
        }


        return [
            'status' => true,
            'message' => 'success',
            'statusCode' => 200,
            'data' => null
        ];
    }

    /**
     * @return array
     */
    public function getUpdateFields()
    {
        return [
            TextField::make('name')->setRules('required|min:3|max:255'),
            TextField::make('position')->setRules('required|min:3|max:255'),
            TextField::make('login')->setRules('required|min:5|max:1024'),
            TextField::make('profil_photo_path')->setRules('nullable'),
            TextField::make('color')->setRules('nullable'),
            TextField::make('percent_salary')->setRules('required|integer'),
            TextField::make('salary_static')->setRules('required|integer'),
            TextField::make('sort_order')->setRules('required|integer'),
        ];
    }

    //</editor-fold>

    /**
     * @param $id
     * @return UserResource|mixed
     */
    public function show($id)
    {
        $model = $this->model::find($id);

        if (!$model){
            return [
                'status' => false,
                'message' => 'Staff not found',
                'statusCode' => 403,
                'data' => null
            ];
        }
        return [
            'status' => true,
            'message' => 'success',
            'statusCode' => 200,
            'data' => new UserResources($model)
        ];

    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $item = $this->model::find($id);

        if ($item) {

            if ($item->status == Status::$status_deleted) {

                return [
                    'status' => false,
                    'message' => 'User deleted',
                    'statusCode' => 403,
                    'data' => null
                ];
            }

            $item->status = Status::$status_deleted;

            if ($item->save()) {
                return [
                    'status' => true,
                    'message' => 'success',
                    'statusCode' => 200,
                    'data' => new UserResources($item)
                ];
            }
        }
        return [
            'status' => false,
            'message' => 'There was a problem deleting',
            'statusCode' => 403,
            'data' => null
        ];
    }

    public function testLogin($data)
    {
        $item = $this->model::where('status', Status::$status_active)
            ->where('login', $data['login'])
            ->first();

        if (!$item){
            return [
                'status' => false,
                'message' => 'Success',
                'statusCode' => 404,
            ];
        }

        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
        ];
    }

    /**
     * @return array
     */
    public function checkSortOrder()
    {
        $staffCount = $this->model::where('polyclinic_id', Auth::user()->polyclinic_id)
            ->where('status', '!=', User::$status_deleted)
            ->where('role', '!=', User::$role_admin)
            ->count();

        return [
            'status' => true,
            'message' => 'success',
            'statusCode' => 200,
            'data' => [
                'nextCount' => ++$staffCount
            ]
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    public function search(array $data)
    {
        $key = $data['search'] ?? '';
        $column = $data['column'] ?? 'sort_order';
        $sort = $data['sort'] ?? 'asc';

        $items = $this->model::where(function ($query) use ($key) {
            empty($key) ? $query : $query->where('name', 'like', '%' . $key . '%')
                ->orWhere('position', 'like', '%' . $key . '%')
                ->orWhere('login', 'like', '%' . $key . '%');
        })
            ->where('status', '!=', Status::$status_deleted)
            ->orderBy($column, $sort)
            ->paginate($data['paginate']);

        $data = [
            'items' => UserResources::collection($items),
            'pagination' => [
                'total' => $items->total(),
                'per_page' => $items->perPage(),
                'current_page' => $items->currentPage(),
                'last_page' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem(),
            ],
        ];

        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
            'data' => $data
        ];
    }
}
