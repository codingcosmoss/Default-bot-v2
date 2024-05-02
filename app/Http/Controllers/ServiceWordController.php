<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceAnketa;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ServiceWordController extends Controller
{

  /**
   * @param $service_id
   * @return Application|Factory|View
   */
  public function add($service_id)
  {
    $menuActive = 'service';
    $slot = false;
    $title = "Xizmatga anketa biriktirish";
    $service = Service::find($service_id);

    return view('admin.service-word.add', compact('title', 'slot', 'menuActive', 'service'));
  }

  public function store(Request $request)
  {
    ServiceAnketa::where('service_id', $request->service_id)
      ->delete();

    if ($request->anketa) {

      foreach ($request->anketa as $item) {
        $model = new ServiceAnketa();
        $model->service_id = $request->service_id;
        $model->anketa_number = $item;
        $model->save();
      }
    }

    return redirect('/admin/service');
  }
}
