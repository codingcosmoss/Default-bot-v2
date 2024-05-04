@php
    /**
     * User: uluGbek
     * @author Ulugbek Muhammadjonov
     * @email <muhammadjonovulugbek98@gmail.com>
     * Date: 18.08.2023  9:36
     */

    /** @var \App\Models\Treatment[] $model */

    $settings = \App\Models\CompanySetting::first();

    $serviceIds = $model
    ->services
    ->pluck('service_id')
    ->toArray();

    $serviceAnketaNumberArray = \App\Models\ServiceAnketa::whereIn('id',$serviceIds)
     ->pluck('anketa_number')
    ->toArray();

    $arrayUnique = array_unique($serviceAnketaNumberArray);

//    $arrayTeethNumbers = $model
//    ->groups
//    ->pluck('tooth_numbers')
//    ->toArray();
//    $toothArray = [];
//
//    foreach ($arrayTeethNumbers as $arrayTeethNumber){
//          $tooths = explode(',',$arrayTeethNumber);
//          foreach ($tooths as $tooth){
//              $toothArray[] =intval($tooth);
//          }
//    }

//    $toothArray = array_unique($toothArray);

@endphp
@include('anketa._header')
@include('anketa._teeths')
@if(in_array(\App\Models\ServiceAnketa::$anketa_1,$serviceAnketaNumberArray))
    @include('anketa.1_anketa')
@endif
@if(in_array(\App\Models\ServiceAnketa::$anketa_2,$serviceAnketaNumberArray))
    @include('anketa.2_anketa')
@endif
@if(in_array(\App\Models\ServiceAnketa::$anketa_3,$serviceAnketaNumberArray))
    @include('anketa.3_anketa')
@endif
@if(in_array(\App\Models\ServiceAnketa::$anketa_4,$serviceAnketaNumberArray))
    @include('anketa.4_anketa')
@endif
@if(in_array(\App\Models\ServiceAnketa::$anketa_5,$serviceAnketaNumberArray))
    @include('anketa.5_anketa')
@endif
@if(in_array(\App\Models\ServiceAnketa::$anketa_6,$serviceAnketaNumberArray))
    @include('anketa.6_anketa')
@endif
@if(in_array(\App\Models\ServiceAnketa::$anketa_7,$serviceAnketaNumberArray))
    @include('anketa.7_anketa')
@endif
@if(in_array(\App\Models\ServiceAnketa::$anketa_8,$serviceAnketaNumberArray))
    @include('anketa.8_anketa')
@endif
@if(in_array(\App\Models\ServiceAnketa::$anketa_9,$serviceAnketaNumberArray) && count($arrayUnique) == 1)
    @include('anketa.9_anketa')
@endif
@if(in_array(\App\Models\ServiceAnketa::$anketa_10,$serviceAnketaNumberArray))
    @include('anketa.10_anketa')
@endif
@if(in_array(\App\Models\ServiceAnketa::$anketa_11,$serviceAnketaNumberArray))
    @include('anketa.11_anketa')
@endif
@if(in_array(\App\Models\ServiceAnketa::$anketa_12,$serviceAnketaNumberArray))
    @include('anketa.12_anketa')
@endif
@if(in_array(\App\Models\ServiceAnketa::$anketa_13,$serviceAnketaNumberArray))
    @include('anketa.13_anketa')
@endif
@if(in_array(\App\Models\ServiceAnketa::$anketa_14,$serviceAnketaNumberArray))
    @include('anketa.14_anketa')
@endif
@if(in_array(\App\Models\ServiceAnketa::$anketa_15,$serviceAnketaNumberArray))
    @include('anketa.15_anketa')
@endif
@if(in_array(\App\Models\ServiceAnketa::$anketa_16,$serviceAnketaNumberArray))
    @include('anketa.16_anketa')
@endif
@if(in_array(\App\Models\ServiceAnketa::$anketa_17,$serviceAnketaNumberArray))
    @include('anketa.17_anketa')
@endif
@if(in_array(\App\Models\ServiceAnketa::$anketa_18,$serviceAnketaNumberArray))
    @include('anketa.18_anketa')
@endif
@if(in_array(\App\Models\ServiceAnketa::$anketa_19,$serviceAnketaNumberArray))
    @include('anketa.19_anketa')
@endif
@if(in_array(\App\Models\ServiceAnketa::$anketa_20,$serviceAnketaNumberArray))
    @include('anketa.20_anketa')
@endif
@if(in_array(\App\Models\ServiceAnketa::$anketa_21,$serviceAnketaNumberArray))
    @include('anketa.21_anketa')
@endif
@include('anketa._footer')
