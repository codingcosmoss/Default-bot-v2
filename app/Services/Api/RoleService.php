<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ClinicUserResource;
use App\Http\Resources\RoleResource;
use App\Models\ClinicUser;
use App\Models\Menu;
use App\Models\Notification;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Traits\Status;
use Illuminate\Support\Str;
use Mockery\Exception;


class RoleService extends AbstractService
{
    protected $model = Role::class;
    protected $resource = RoleResource::class;
    protected $columns = ['name'];
    protected $menu = 'Role&Permissions';
    protected $isClinic = true; // Clinikalarga bog'liqmi yoki yo'qmi

    public function storeFields()
    {
        return [
            TextField::make('name')->setRules('required|string'),
            TextField::make('permissions')->setRules('nullable|array'),
        ];
    }
    public function updateFields()
    {
        return [
            TextField::make('name')->setRules('required|string'),
            TextField::make('permissions')->setRules('nullable|array'),
        ];
    }

    public function index()
    {
        try {
            if (!$this->hasPermission('index')){
                return [
                    'status' => false,
                    'code' => 403,
                    'message' => 'Root access is not allowed ',
                    'data' => null
                ];
            }

            $data = $this->resource::collection(
                $this->model::where('clinic_id', auth()->user()->clinic_id)
                    ->where('private', Status::$status_inactive)
                    ->get()
            );

            return [
                'status' => true,
                'code' => 200,
                'message' => 'Success',
                'data' => $data
            ];

        }catch (Exception $e){
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => null
            ];
        }

    }
    public function getPaginate($count = 10)
    {

        try {

            if (!$this->hasPermission('index')){
                return [
                    'status' => false,
                    'code' => 403,
                    'message' => 'Root access is not allowed ',
                    'data' => null
                ];
            }

            $models = $this->model::where('clinic_id', auth()->user()->clinic_id)
                ->where('private', Status::$status_inactive)
                ->orderBy('id', 'asc')
                ->paginate($count);

            $data = [
                'items' => $this->resource::collection($models),
                'pagination' => [
                    'total' => $models->total(),
                    'per_page' => $models->perPage(),
                    'current_page' => $models->currentPage(),
                    'last_page' => $models->lastPage(),
                    'from' => $models->firstItem(),
                    'to' => $models->lastItem(),
                ],
            ];

            return [
                'status' => true,
                'code' => 200,
                'message' => 'Success',
                'data' => $data
            ];
        }catch (Exception $e){
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    public function getRoleNotification($id)
    {
        try {

            $data = Notification::where('clinic_id', auth()->user()->clinic_id)
                ->where('type', Status::$change_role)
                ->where('model_id', $id)
                ->latest()
                ->first();

            $data = [
                'token' => $data != null ? $data->token : '---',
                'user_id' => $data != null ? $data->user_id : 0
            ];

            return [
                'status' => true,
                'code' => 200,
                'message' => 'Success',
                'data' => $data
            ];
        }catch (Exception $e){
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    public function store(array $data)
    {
        try {
            if (!$this->hasPermission('create')){
                return [
                    'status' => false,
                    'code' => 403,
                    'message' => 'Root access is not allowed ',
                    'data' => null
                ];
            }
            $validator = $this->dataValidator($data, $this->storeFields());

            if ($validator['status']) {
                return [
                    'status' => false,
                    'code' => 422,
                    'message' => 'Validator error',
                    'errors' => $validator['validator']
                ];
            }

            $data = $validator['data'];
            $object = new $this->model;
            $object->name = $data['name'];
            $object->clinic_id = auth()->user()->clinic_id;
            $object->save();

            if ($object->private == Status::$status_active){
                return [
                    'status' => false,
                    'message' => 'Private madel',
                    'data' => null
                ];
            }

            $alert = new Notification();
            $alert->name = "Change role";
            $alert->desc = "The user role named ".$object->name." has been changed";
            $alert->type = Status::$change_role;
            $alert->model_id = $object->id;
            $alert->clinic_id = auth()->user()->clinic_id;
            $alert->token =  Str::random(10);
            $alert->save();

            if (isset($data['permissions'])){
                foreach ($data['permissions'] as $permission){
                    $modelPermission = Permission::find($permission);
                    $menu = Menu::find($modelPermission->menu_id);
                    if ($menu){
                        $model = new RolePermission();
                        $model->role_id = $object->id;
                        $model->permission_id = $permission;
                        $model->permission_name = $menu->name.'-'.$modelPermission->name;
                        $model->save();
                    }
                }

            }

            return [
                'status' => true,
                'code' => 200,
                'message' => 'Success',
                'data' => new $this->resource($object)
            ];


        }catch (Exception $e){
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => null
            ];
        }

    }
    public function update(array $data, $id)
    {
        try {

            if (!$this->hasPermission('update')){
                return [
                    'status' => false,
                    'code' => 403,
                    'message' => 'Root access is not allowed ',
                    'data' => null
                ];
            }

            $item = $this->model::find($id);
            $validator = $this->dataValidator($data, $this->updateFields());
            if ($validator['status']) {
                return [
                    'status' => false,
                    'code' => 422,
                    'message' => 'Validator error',
                    'errors' => $validator['validator']
                ];
            }

            $data = $validator['data'];
            $item->name = $data['name'];
            $item->save();

            $alert = new Notification();
            $alert->name = "Change role";
            $alert->desc = "The user role named ".$item->name." has been changed";
            $alert->type = Status::$change_role;
            $alert->model_id = $item->id;
            $alert->clinic_id = auth()->user()->clinic_id;
            $alert->token =  Str::random(10);
            $alert->save();

            if (isset($data['permissions'])){
                $item->permissions()->detach();
                foreach ($data['permissions'] as $permission){
                    $modelPermission = Permission::find($permission);
                    $menu = Menu::find($modelPermission->menu_id);
                    if ($menu){
                        $model = new RolePermission();
                        $model->role_id = $item->id;
                        $model->permission_id = $permission;
                        $model->permission_name = $menu->name.'-'.$modelPermission->name;
                        $model->save();
                    }
                }
            }

            return [
                'status' => true,
                'code' => 200,
                'message' => 'Success',
                'data' => new $this->resource($item)
            ];

        }catch (Exception $e){
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    public function destroy($id)
    {
        try {
            if (!$this->hasPermission('delete')){
                return [
                    'status' => false,
                    'code' => 403,
                    'message' => 'Root access is not allowed ',
                    'data' => null
                ];
            }

            $item = $this->model::find($id);
            if (count($item->users) > 0 || $item->private == Status::$status_active){
                return [
                    'status' => false,
                    'code' => 403,
                    'message' => 'Deletion is prohibited',
                    'data' => null
                ];
            }
            $item->delete($id);
            return [
                'status' => true,
                'code' => 200,
                'message' => 'Success',
                'data' => $item
            ];
        }catch (Exception $e){
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }
    public function search($search = '')
    {
        if (!$this->hasPermission('index')){
            return [
                'status' => false,
                'code' => 403,
                'message' => 'Root access is not allowed ',
                'data' => null
            ];
        }

        if ($this->isClinic){
            $data = $this->model::where(function ($query) use ($search) {
                foreach ($this->columns as $column) {
                    $query->orWhere($column, 'like', '%' . $search . '%');
                }
            })
                ->where('private', Status::$status_inactive)
                ->where('clinic_id', auth()->user()->clinic_id)
                ->limit(10)
                ->get();
        }else{
            $data = $this->model::where(function ($query) use ($search) {
                foreach ($this->columns as $column) {
                    $query->orWhere($column, 'like', '%' . $search . '%');
                }
            })
                ->limit(10)
                ->get();
        }

        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
            'data' => $this->resource::collection($data)
        ];
    }


}
