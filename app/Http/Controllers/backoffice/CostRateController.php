<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\Controller;
use App\Models\CostRate;
use App\Models\Partner;
use Illuminate\Http\Request;

class CostRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $costRates = CostRate::paginate(env('TABLE_PAGINATE'));

        return view('backoffice.cost-rates.index', compact('costRates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partners = Partner::all();
        $provinces = \Indonesia::allProvinces();
        
        return view('backoffice.cost-rates.create', compact('partners', 'provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'sender_sub_district' => 'required',
            'sender_city' => 'required',
            'sender_province' => 'required',
            'destination_sub_district' => 'required',
            'destination_city' => 'required',
            'destination_province' => 'required',
            'weight' => 'required|numeric',
            'ctg_type' => 'required',
            'cost' => 'required',
            'transport_type' => 'required',
        ]);

        $sender_sub_district = strpos($request->sender_sub_district, '#') > 0 ? explode('#', $request->sender_sub_district)[1] : $request->sender_sub_district;
        $sender_city = strpos($request->sender_city, '#') > 0 ? explode('#', $request->sender_city)[1] : $request->sender_city;
        $sender_province = strpos($request->sender_province, '#') > 0 ? explode('#', $request->sender_province)[1] : $request->sender_province;
        $destination_sub_district = strpos($request->destination_sub_district, '#') > 0 ? explode('#', $request->destination_sub_district)[1] : $request->destination_sub_district;
        $destination_city = strpos($request->destination_city, '#') > 0 ? explode('#', $request->destination_city)[1] : $request->destination_city;
        $destination_province = strpos($request->destination_province, '#') > 0 ? explode('#', $request->destination_province)[1] : $request->destination_province;

        $request->merge([
            'cost' => str_replace(",", "", $request->cost),
            'sender_sub_district' => $sender_sub_district,
            'sender_city' => $sender_city,
            'sender_province' => $sender_province,
            'destination_sub_district' => $destination_sub_district,
            'destination_city' => $destination_city,
            'destination_province' => $destination_province,
        ]);

        CostRate::create($request->all());

        return redirect()->route('cost-rates.create')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CostRate $costRate)
    {
        $partners = Partner::all();
        $provinces = \Indonesia::allProvinces();

        return view('backoffice.cost-rates.edit', compact('costRate', 'partners', 'provinces'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CostRate $costRate)
    {
        $request->validate([
            'sender_sub_district' => 'required',
            'sender_city' => 'required',
            'sender_province' => 'required',
            'destination_sub_district' => 'required',
            'destination_city' => 'required',
            'destination_province' => 'required',
            'weight' => 'required|numeric',
            'ctg_type' => 'required',
            'cost' => 'required',
        ]);

        $sender_sub_district = strpos($request->sender_sub_district, '#') > 0 ? explode('#', $request->sender_sub_district)[1] : $request->sender_sub_district;
        $sender_city = strpos($request->sender_city, '#') > 0 ? explode('#', $request->sender_city)[1] : $request->sender_city;
        $sender_province = strpos($request->sender_province, '#') > 0 ? explode('#', $request->sender_province)[1] : $request->sender_province;
        $destination_sub_district = strpos($request->destination_sub_district, '#') > 0 ? explode('#', $request->destination_sub_district)[1] : $request->destination_sub_district;
        $destination_city = strpos($request->destination_city, '#') > 0 ? explode('#', $request->destination_city)[1] : $request->destination_city;
        $destination_province = strpos($request->destination_province, '#') > 0 ? explode('#', $request->destination_province)[1] : $request->destination_province;

        $request->merge([
            'cost' => str_replace(",", "", $request->cost),
            'sender_sub_district' => $sender_sub_district,
            'sender_city' => $sender_city,
            'sender_province' => $sender_province,
            'destination_sub_district' => $destination_sub_district,
            'destination_city' => $destination_city,
            'destination_province' => $destination_province,
        ]);

        $costRate->update($request->all());

        return redirect()->route('cost-rates.edit', $costRate->id)->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CostRate $costRate)
    {
        $costRate->delete();

        return redirect()->route('cost-rates')->with('success', 'Data berhasil dihapus');
    }
}
