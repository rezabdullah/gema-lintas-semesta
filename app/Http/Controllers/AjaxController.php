<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function provinces()
    {
        $provinces = \Indonesia::allProvinces();

        return response()->json($provinces);
    }

    public function cities(Request $request)
    {
        $cities = \Indonesia::findProvince($request->id)->cities->pluck('name', 'id');

        return response()->json($cities);
    }

    public function districts(Request $request)
    {
        $districts = \Indonesia::findCity($request->id)->districts->pluck('name', 'id');

        return response()->json($districts);
    }

    public function partner(Request $request)
    {
        $partner = Partner::with('cost_rates')->find($request->id);

        return response()->json($partner);
    }
}
