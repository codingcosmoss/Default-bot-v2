<?php

namespace App\Services\Api;

use App\Events\TelegramMessage;
use App\Fields\Store\TextField;
use App\Http\Resources\DiseaseResource;
use App\Http\Resources\OneUserResource;
use App\Http\Resources\PatientResource;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\PaymentTypeResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResources;
use App\Jobs\TelegramSendMessage;
use App\Listeners\SendTelegramMessage;
use App\Models\CompanySetting;
use App\Models\Discount;
use App\Models\Disease;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\PaymentType;
use App\Models\Telegram;
use App\Models\Treatment;
use App\Models\User;
use App\Traits\Action;
use App\Traits\Status;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PaymentService extends AbstractService
{
    /**
     * @var string
     */
    protected $model = Payment::class;
    protected $resource = PaymentResource::class;

    /**
     * @return mixed
     */
    public function index($data = null)
    {
        $models = $this->model::join('patients', 'payments.patient_id', '=', 'patients.id')
            ->select('payments.*', 'patients.first_name', 'patients.last_name')
            ->orderBy('payments.updated_at', 'desc')
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

    public function isActives($data = null)
    {
        $models = $this->model::where('status', Status::$status_active)
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

    /**
     * @return array
     */
    public function getFields()
    {
        return [
            TextField::make('patient_id')->setRules('required|integer'),
            TextField::make('payment_type_id')->setRules('required|integer'),
            TextField::make('treatment_id')->setRules('required|integer'),
            TextField::make('amount')->setRules('required|integer'),
        ];
    }

    /**
     * @return array
     */
    public function getUpdateFields()
    {
        return [
            TextField::make('patient_id')->setRules('required|integer'),
            TextField::make('payment_type_id')->setRules('required|integer'),
            TextField::make('treatment_id')->setRules('required|integer'),
            TextField::make('amount')->setRules('required|integer'),
        ];
    }
    public function paymentFields()
    {
        return [
            TextField::make('patient_id')->setRules('required|integer'),
            TextField::make('treatment_id')->setRules('required|integer'),
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
            $model->patient_id = $data['patient_id'];
            $model->payment_type_id = $data['payment_type_id'];
            $model->treatment_id = $data['treatment_id'];
            $model->amount = $data['amount'];

            if ($model->save()) {
                DB::commit();

                // Telegram botga xabar yuborish
//                event(new TelegramMessage('payment', $model));

                TelegramSendMessage::dispatch('payment', $model );

                $payments = Payment::where('patient_id', $data['patient_id'])
                    ->where( "treatment_id", $data['treatment_id'] )
                    ->sum('amount');
                $treatment = Treatment::find($data['treatment_id']);
                $realPrice = $treatment->service_real_price - $treatment->discount_sum;
                if ($payments == $realPrice ){
                    $treatment->payment_status = Status::$Closed;
                }else if($payments < $realPrice ){
                    $treatment->payment_status = Status::$notFullyPaid;
                }
                $treatment->save();
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

    public function getUserTreatmentPayments($data)
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


        $payments = Payment::where('patient_id', $data['patient_id'])
            ->where( "treatment_id", $data['treatment_id'] )
            ->sum('amount');

        return [
            'status' => true,
            'message' => 'success',
            'statusCode' => 200,
            'data' => $payments
        ];
    }

    public function getUserPayments($id)
    {
        $payments = Payment::where('patient_id', $id)
            ->sum('amount');

        return [
            'status' => true,
            'message' => 'success',
            'statusCode' => 200,
            'data' => $payments
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

        $model = $this->model::where('id', $id)
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

            $model->payment_type_id = $data['payment_type_id'];
            $model->amount = $data['amount'];


            if ($model->save()) {
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
            $model->delete();
            if ($model->save()) {
                return [
                    'status' => true,
                    'message' => 'success',
                    'statusCode' => 200,
                    'data' =>  null
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
        $column = $data['column'] ?? 'payments.updated_at';
        $sort = $data['order'] ?? 'desc';

        $models = $this->model::join('patients', 'payments.patient_id', '=', 'patients.id')
            ->select('payments.*', 'patients.first_name', 'patients.last_name')
            ->where(function ($query) use ($key) {
                empty($key) ? $query : $query->where('patients.first_name', 'like', '%' . $key . '%');
                empty($key) ? $query : $query->where('patients.last_name', 'like', '%' . $key . '%');
                empty($key) ? $query : $query->where('payments.amount', 'like', '%' . $key . '%');
                empty($key) ? $query : $query->where('payments.updated_at', 'like', '%' . $key . '%');
                empty($key) ? $query : $query->where('payments.created_at', 'like', '%' . $key . '%');
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
