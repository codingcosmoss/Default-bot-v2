<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\OneUserResource;
use App\Http\Resources\PatientResource;
use App\Http\Resources\ServiceItemsResource;
use App\Http\Resources\TreatmentResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResources;
use App\Jobs\TelegramSendMessage;
use App\Listeners\SendTelegramMessage;
use App\Models\Collection;
use App\Models\CollectionProduct;
use App\Models\CompanySetting;
use App\Models\Discount;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\PersonalPrice;
use App\Models\Product;
use App\Models\Service;
use App\Models\Telegram;
use App\Models\TreatmentService as ModelTreatmentService;
use App\Models\Treatment;
use App\Models\UsedProduct;
use App\Models\User;
use App\Traits\Action;
use App\Traits\Status;
use Carbon\Carbon;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TreatmentService extends AbstractService
{
    /**
     * @var string
     */
    protected $model = Treatment::class;
    protected $resource = TreatmentResource::class;

    /**
     * @return mixed
     */
    public function index($data = null)
    {
        $models = $this->model::orderBy('updated_at', 'desc')
            ->paginate($data['pages']);

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
            'message' => 'Success',
            'statusCode' => 200,
            'data' => $data
        ];
    }

    public function employeeTreatments($id )
    {
        $treatments = $this->model::where('user_id', $id)
                ->where('status', '!=', Status::$canceled)
                ->get();

        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
            'data' => TreatmentResource::collection($treatments)
        ];
    }




    public function deptorIndex($data = null)
    {
        $models = $this->model::where('status', '!=', Status::$new)
            ->where('status', '!=', Status::$canceled)
            ->where(function($query) {
                $query->orWhere('payment_status', Status::$unpaid)
                    ->orWhere('payment_status', Status::$notFullyPaid);
            })
            ->orderBy('updated_at', 'desc')
            ->paginate($data['pages']);

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
            'message' => 'Success',
            'statusCode' => 200,
            'data' => $data
        ];
    }


    public function closed($data)
    {

        $fields = $this->getClosedFields();

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

        $treatment = $this->model::find($data['treatment_id']);

        if ($treatment){
            $treatment->status = Status::$canceled;
            $treatment->cancleted_description = $data['description'];
            $treatment->save();
        }

        return [
            'status' => true,
            'message' => 'Success',
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
            TextField::make('first_name')->setRules('required|min:3|max:255'),
            TextField::make('last_name')->setRules('nullable|min:3|max:255'),
            TextField::make('phone')->setRules('nullable|numeric'),
            TextField::make('job')->setRules('nullable|min:3|max:255'),
            TextField::make('address')->setRules('nullable|min:3|max:255'),
            TextField::make('gender')->setRules('required|integer'),
            TextField::make('birthday')->setRules('nullable'),
            TextField::make('price')->setRules('nullable|integer'),
            TextField::make('sort_order')->setRules('nullable:integer'),
            TextField::make('diseasesIds')->setRules('nullable'),
        ];
    }

    public function getAttachFields()
    {
        return [
            TextField::make('start')->setRules('required|date'),
            TextField::make('hour')->setRules('required|integer'),
            TextField::make('user_id')->setRules('required|numeric'),
            TextField::make('patient_id')->setRules('required|numeric'),
            TextField::make('reception_description')->setRules('nullable'),

        ];
    }

    public function getClosedFields()
    {
        return [
            TextField::make('treatment_id')->setRules('required|numeric'),
            TextField::make('description')->setRules('required'),
        ];
    }

    public function getDiscountFields()
    {
        return [
            TextField::make('treatment_id')->setRules('required|numeric'),
            TextField::make('discount_total_sum')->setRules('required|numeric'),
            TextField::make('discounter')->setRules('required|numeric'),
            TextField::make('discount_percent')->setRules('required|numeric'),
            TextField::make('discount_sum')->setRules('required|numeric'),
        ];
    }

    public function discount(array $data)
    {
        $fields = $this->getDiscountFields();

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

            $model = $this->model::find($data['treatment_id']);
            $model->type_of_discount = $data['discounter'];
            $model->discount_total_sum = $data['discount_total_sum']; // Chegirmani umumiy summasi
            $model->discount_percent = $data['discount_percent']; // Chegrima miqdori foizda
            $model->discount_sum = $data['discount_sum']; // 	Chegirma miqdori sumda
            $model->user_id = auth()->user()->id;

//            $amount = $model->service_real_price - Payment::where('patient_id',$model->patient_id )->where('treatment_id', $model->id )->sum('amount');
//            if ($amount == $data['discount_sum']){
//                $model->payment_status =
//            }

            if ($model->save()) {
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
            'data' => $model
        ];
    }

    public function treatmentFinished($id)
    {
        $treatment =  Treatment::find($id);
        $services = ModelTreatmentService::where('treatment_id', $treatment->id)->get();



        // Telegram botga xabar yuborish
        TelegramSendMessage::dispatch('treatment', $treatment , $services);
//        event(new SendTelegramMessage('treatment', $treatment , $services));

        if ($treatment){
            $treatment->status = Status::$finished;
            $treatment->save();

            return [
                'status' => true,
                'message' => 'Success',
                'statusCode' => 200,
                'data' => null
            ];
        }
        return [
            'status' => false,
            'message' => 'Treatment not fount',
            'statusCode' => 200,
            'data' => null
        ];
    }

    public function treatmentAddServiceAll($id)
    {

        session(['treatment_id' => $id]);
        $treatmentServices =  ModelTreatmentService::where('treatment_id', $id )
            ->get();

        $data = [
            'items' => ServiceItemsResource::collection($treatmentServices),
        ];

        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
            'data' => $data
        ];
    }



    public function treatmentAddService(array $data)
    {
        try {

            $usedProducts = UsedProduct::where('treatment_id', $data['treatment_id'])->delete();

            if (isset($data['items'])){
                $services = ModelTreatmentService::where( 'treatment_id' , $data['treatment_id'])->delete();
                foreach ($data['items'] as $item) {

                    $service = Service::find($item['id']);
                    if ($service){

                        $collectionProducts = CollectionProduct::join('products', 'products.id', 'collection_products.product_id')
                            ->select('products.*', 'collection_products.amount')
                            ->where('collection_products.collection_id', $service->collection_id)
                            ->get();


                        if (count($collectionProducts) > 0){
                            foreach ($collectionProducts as $product){
                                $usedProducts = new UsedProduct();
                                $usedProducts->product_id = $product->id;
                                $usedProducts->treatment_id = $data['treatment_id'];
                                $usedProducts->amount = $product->amount * $item['count'];
                                $usedProducts->size_type = $product->size_type;
                                $usedProducts->save();
                            }

                        }
                    }

                    $model = new ModelTreatmentService();
                    $model->service_id = $item['id'];
                    $model->amount = $item['count'];
                    $model->treatment_id = $data['treatment_id'];
                    $model->save();

                }
            }else{
                return [
                    'status' => false,
                    'message' => 'success',
                    'statusCode' => 403,
                    'data' => null
                ];
            }

        } catch (\Exception $ex) {
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
            'data' => $model
        ];
    }

    public function treatmentSavedService(array $data)
    {

        try {

            $usedProducts = UsedProduct::where('treatment_id', $data['treatment_id'])->delete();


            if (isset($data['items'])){
                $services = ModelTreatmentService::where( 'treatment_id' , $data['treatment_id'])->delete();
                $sum = 0;
                $doctorSum = 0; // doctorga beriladigan pul miqdori
                $materialSum = 0; // Material narxi
                $treatment = Treatment::find($data['treatment_id']);

                foreach ($data['items'] as $item) {

                    $model = new ModelTreatmentService();
                    $service = Service::find($item['id']);

                    $model->service_id = $item['id'];
                    $model->amount = $item['count'];
                    $model->result_price = $item['count'] * $service->price;
                    $model->treatment_id = $data['treatment_id'];
                    $model->service_name = $service->name;
                    $model->save();

                    $sum += $model->amount * $service->price;
                    $materialSum += Collection::find($service->collection_id) != null ? Collection::find($service->collection_id)->product_total_sum : 0;
                    $personelPrice = PersonalPrice::where('employee_id', $treatment->user_id)->where('service_id', $item['id'] )->first();

                    if ($personelPrice){
                        $doctorSum += $personelPrice->result_price *  $model->amount;
                    }

                    if ($service) {

                        $collectionProducts = CollectionProduct::join('products', 'products.id', 'collection_products.product_id')
                            ->select('products.*', 'collection_products.amount')
                            ->where('collection_products.collection_id', $service->collection_id)
                            ->get();

                        if (count($collectionProducts) > 0) {
                            foreach ($collectionProducts as $product) {
                                $usedProducts = new UsedProduct();
                                $usedProducts->product_id = $product->id;
                                $usedProducts->treatment_id = $data['treatment_id'];
                                $usedProducts->amount = $product->amount * $item['count'];
                                $usedProducts->size_type = $product->size_type;
                                $usedProducts->save();
                            }

                        }
                    }

                }

                $treatment->service_real_price = $sum + $materialSum;
                $treatment->doctor_result_sum = $doctorSum; // Doctrga beriladigan pul;
                $treatment->material_price = $materialSum; // material narxi
                $treatment->status = Status::$doctorFinished;
                $treatment->save();

            }else{
                return [
                    'status' => false,
                    'message' => 'success',
                    'statusCode' => 403,
                    'data' => null
                ];
            }

        } catch (\Exception $ex) {
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
            'data' => $model
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
            $model = new $this->model;
            $model->first_name = $data['first_name'];
            $model->last_name = $data['last_name'];
            $model->phone = $data['phone'];
            $model->job = $data['job'];
            $model->address = $data['address'];
            $model->gender = $data['gender'];
            $model->sort_order = $data['sort_order'];
            $model->birthday = $data['birthday'];
            $model->price = $data['price'];
            $model->status = Status::$notSaved;

            if ($model->save()) {
                DB::commit();
                if ($data['diseasesIds'] != 0) {
                    $model->diseases()->attach($data['diseasesIds']);
                }
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
            'data' => $model
        ];
    }

    /**
     * @param array $data
     * @return JsonResponse|mixed
     */
    public function joinDr(array $data)
    {
        $fields = $this->getAttachFields();

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

        // // Berilgan vaqt
        // $time = $data['hour'];

        // // Vaqtning soat va daqiqa bo'linishi
        // list($hours, $minutes) = explode(':', $time);

        // // Vaqtni minutga o'tkazish
        // $totalMinutes = ($hours * 60) + $minutes;

        // Carbon klasidan foydalanib, berilgan vaqtni obyektga aylantiramiz
        $carbonStart = Carbon::createFromFormat('Y-m-d H:i', date('Y-m-d H:i', strtotime($data['start'])));

        // 1800 daqiqa (30 soat) qo'shamiz
        $end = $carbonStart->addMinutes($data['hour'])->toDateTimeString();


        DB::beginTransaction();
        try {

            $model = new Treatment();
            $model->user_id = $data['user_id'];
            $model->patient_id = $data['patient_id'];
            $model->start = strtotime($data['start']);
            $model->end =  date('Y-m-d H:i', strtotime($end));
            $model->reception_description = $data['reception_description'];
//            $model->status = Status::$status_active;

            if ($model->save()) {
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
            'data' => $model
        ];
    }


    //<editor-fold desc="Edit">
    /**
     * @param array $data
     * @param $id
     * @return JsonResponse|mixed
     */
    public function update(array $data, $id)
    {
        $model = $this->model::where('status', Status::$status_active)
            ->where('id', $id)
            ->first();

        if (!$model) {
            return [
                'status' => false,
                'message' => "User deleted ",
                'statusCode' => 404,
                'data' => null
            ];
        }

        //        if ($model->role != User::$role_doctor) {
        //            return [
        //                'status' => false,
        //                'message' => "Siz noto'g'ri apiga ma'lumot yuboryabsiz!",
        //                'statusCode' => 403,
        //                'data' => null
        //            ];
        //        }

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
                'statusCode' => 403,
                'data' => $errors
            ];
        }

        DB::beginTransaction();
        try {

            $model->first_name = $data['first_name'];
            $model->last_name = isset($data['last_name']) ? $data['last_name'] : '';
            $model->phone = isset($data['phone']) ? $data['phone'] : '';
            $model->job =  isset($data['job']) ? $data['job'] : '';
            $model->address = isset($data['address']) ? $data['address'] : '';
            $model->gender = $data['gender'];
            $model->birthday = isset($data['birthday']) ? $data['birthday'] : '';
            $model->sort_order = isset($data['sort_order']) ? $data['sort_order'] : '';
            $model->price = isset($data['price']) ? $data['price'] : '';
            $model->status = Status::$status_active;


            if ($model->save()) {
                DB::commit();
                $model->diseases()->detach();
                if ($data['diseasesIds'] != 0) {
                    $model->diseases()->attach($data['diseasesIds']);
                }
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
            'data' => $model
        ];
    }


    /**
     * @param $id
     * @return UserResource|mixed
     */
    public function show($id)
    {
        $model = $this->model::find($id);

        if (!$model) {
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
            'data' => new $this->resource($model)
        ];
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $model = $this->model::find($id);
        if ($model) {

            if ($model->status == Status::$status_deleted) {

                return [
                    'status' => false,
                    'message' => 'User deleted',
                    'statusCode' => 403,
                    'data' => null
                ];
            }

            $model->delete();

            if ($model->save()) {
                return [
                    'status' => true,
                    'message' => 'success',
                    'statusCode' => 200,
                    'data' =>  new $this->resource($model)
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


    /**
     * @param array $data
     * @return array
     */
    public function search(array $data)
    {
        $key = $data['search'] ?? '';
        $column = $data['column'] ?? 'updated_at';
        $sort = $data['order'] ?? 'desc';

        $models = $this->model::join('patients', 'treatments.patient_id', '=', 'patients.id')
            ->select('patients.first_name', 'patients.last_name', 'treatments.*')
            ->where(function ($query) use ($key) {
            empty($key) ? $query : $query->orWhere('patients.first_name', 'like', '%' . $key . '%')
                ->orWhere('patients.last_name', 'like', '%' . $key . '%')
                ->orWhere('treatments.start', 'like', '%' . $key . '%');
        })
            ->orderBy($column, $sort)
            ->paginate($data['paginate']);

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
            'message' => 'Success',
            'statusCode' => 200,
            'data' => $data
        ];
    }

    public function deptorSearch(array $data)
    {

        $key = $data['search'] ?? '';
        $column = $data['column'] ?? 'updated_at';
        $sort = $data['order'] ?? 'desc';

        $models = $this->model::join('patients', 'treatments.patient_id', '=', 'patients.id')
            ->select('patients.first_name', 'patients.last_name', 'treatments.*')
            ->where(function ($query) use ($key) {
                if (!empty($key)) {
                    $query->orWhere('patients.first_name', 'like', '%' . $key . '%')
                        ->orWhere('patients.last_name', 'like', '%' . $key . '%')
                        ->orWhere('treatments.start', 'like', '%' . $key . '%');
                }
            })
            ->where('treatments.status', '!=', Status::$new)
            ->where('status', '!=', Status::$canceled)
            ->where(function($query) {
                $query->orWhere('treatments.payment_status', Status::$unpaid)
                    ->orWhere('treatments.payment_status', Status::$notFullyPaid);
            })
            ->orderBy($column, $sort)
            ->paginate($data['paginate']);

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
            'message' => 'Success',
            'statusCode' => 200,
            'data' => $data
        ];
    }
}
