<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\CompanySettingResource;
use App\Http\Resources\EmployeesPaymentResources;
use App\Http\Resources\TreatmentResource;
use App\Models\CompanySetting;
use App\Models\DailyCost;
use App\Models\Payment;
use App\Models\PaymentType;
use App\Models\Treatment;
use App\Models\User;
use App\Traits\Status;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ReportService extends AbstractService
{

    public function employeesPaymentIndex()
    {

        $models = User::where('login', '!=','admin')->get();

        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
            'data' => EmployeesPaymentResources::collection($models)
        ];

    }

    public function reports($start, $end)
    {
        // to'lov turlari
        $paymentTypes = PaymentType::orderBy('updated_at', 'asc')
            ->get();

        $totalClientPaymentSum = Payment::whereDate('payments.created_at', '>=', $start)
            ->whereDate('payments.created_at', '<=', $end)
            ->sum('amount');

        $stuffGivenTotalSum = Treatment::leftJoin('users', 'treatments.user_id', '=', 'users.id')
            ->whereDate('treatments.doctor_givey_money_at', '>=', $start)
            ->whereDate('treatments.doctor_givey_money_at', '<=', $end)
            ->where('users.login', '!=', 'admin')
            ->where('treatments.is_give_money_doctor', Status::$Closed)
            ->sum('doctor_result_sum');

        $dailyExpensesTotalSum = DailyCost::whereDate('daily_costs.date', '>=', $start)
            ->whereDate('daily_costs.date', '<=', $end)
            ->sum('amount');

        $totalServiceSum = Treatment::whereDate('treatments.start', '>=', $start)
            ->whereDate('treatments.start', '<=', $end)
            ->sum('service_real_price');

        $serviceAmountToBePaid = Treatment::whereDate('treatments.start', '>=', $start)
            ->whereDate('treatments.start', '<=', $end)
            ->sum('service_real_price');

        $totalClientPaymentCashSum = Payment::whereDate('payments.created_at', '>=', $start)
            ->whereDate('payments.created_at', '<=', $end)
            ->where('payment_type_id', 2)
            ->sum('amount');

        $totalCashDailyExpense = DailyCost::whereDate('daily_costs.date', '>=', $start)
            ->whereDate('daily_costs.date', '<=', $end)
            ->sum('amount');


        $data = [
            'paymentTypes' => $paymentTypes,
            'totalClientPaymentSum' => $totalClientPaymentSum,
            'stuffGivenTotalSum' => $stuffGivenTotalSum,
            'dailyExpensesTotalSum' => $dailyExpensesTotalSum,
            'totalServiceSum' => $totalServiceSum,
            'serviceAmountToBePaid' => $serviceAmountToBePaid,
            'totalClientPaymentCashSum' => $totalClientPaymentCashSum,
            'totalCashDailyExpense' => $totalCashDailyExpense
        ];


        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
            'data' => $data
        ];

    }

    public function givenMoneys()
    {

        $finishedTreatments = Treatment::where('is_give_money_doctor', Status::$Closed)
            ->where('payment_status', Status::$Closed)
            ->where('status', Status::$finished)
            ->get();

        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
            'data' => TreatmentResource::collection($finishedTreatments)
        ];

    }

    public function employeesPaymentShow($id)
    {

        $model = User::find($id);

        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
            'data' => new EmployeesPaymentResources($model)
        ];

    }
    public function employeesPaymentStore($data)
    {

        if (count($data['patients']) > 0){
            foreach ($data['patients'] as $value){
                $treatment = Treatment::find($value['id']);
                $treatment->is_give_money_doctor = Status::$Closed;
                $treatment->doctor_givey_money_at =  date("Y-m-d H:i");
                $treatment->technic_or_doctor_payment_type = $data['payment_type_id'];
                $treatment->save();
            }
        }


        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
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

        $models = Treatment::join('patients', 'treatments.patient_id', '=', 'patients.id')
            ->select('patients.first_name', 'patients.last_name', 'treatments.*')
            ->where(function ($query) use ($key) {
                empty($key) ? $query : $query->orWhere('patients.first_name', 'like', '%' . $key . '%')
                    ->orWhere('patients.last_name', 'like', '%' . $key . '%')
                    ->orWhere('treatments.start', 'like', '%' . $key . '%');
            })
            ->where('treatments.is_give_money_doctor', Status::$Closed)
            ->where('treatments.payment_status', Status::$Closed)
            ->where('treatments.status', Status::$finished)
            ->orderBy($column, $sort)
            ->paginate($data['paginate']);

        $data = [
            'items' => TreatmentResource::collection($models),
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

    public function dalyTreatments($year, $moon)
    {

//        $treatments = Treatment::whereYear('created_at', $year)
//            ->whereMonth('created_at', $moon)
//            ->whereBetween(DB::raw('DAY(created_at)'), [1, 30])
//            ->get();
//
//        return [
//            'status' => true,
//            'message' => 'Success',
//            'statusCode' => 200,
//            'data' => TreatmentResource::collection($treatments)
//        ];

    }



}
