<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function province()
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
}
