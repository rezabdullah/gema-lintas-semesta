<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouses = Warehouse::paginate(env('TABLE_PAGINATE'));

        return view('backoffice.warehouses.index', compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = \Indonesia::allProvinces();
        
        return view('backoffice.warehouses.create', compact('provinces'));
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
            'code' => 'required|alpha_num|unique:warehouses',
            'address' => 'required',
            'sub_district' => 'required',
            'city' => 'required',
            'province' => 'required',
        ]);

        $request->merge([
            'sub_district' => explode('#', $request->sub_district)[1],
            'city' => explode('#', $request->city)[1],
            'province' => explode('#', $request->province)[1],
        ]);

        Warehouse::create($request->all());

        return redirect()->route('warehouses.create')->with('success', 'Data berhasil ditambahkan');
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
    public function edit(Warehouse $warehouse)
    {
        $provinces = \Indonesia::allProvinces();

        return view('backoffice.warehouses.edit', compact('warehouse', 'provinces'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        $request->validate([
            'code' => 'required|alpha_num|unique:warehouses,code,'.$warehouse->id,
            'address' => 'required',
            'sub_district' => 'required',
            'city' => 'required',
            'province' => 'required',
            'status' => 'required',
        ]);

        $sub_district = strpos($request->sub_district, '#') > 0 ? explode('#', $request->sub_district)[1] : $request->sub_district;
        $city = strpos($request->city, '#') > 0 ? explode('#', $request->city)[1] : $request->city;
        $province = strpos($request->province, '#') > 0 ? explode('#', $request->province)[1] : $request->province;

        $request->merge([
            'sub_district' => $sub_district,
            'city' => $city,
            'province' => $province,
        ]);

        $warehouse->update($request->all());

        return redirect()->route('warehouses.edit', $warehouse)->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();

        return redirect()->route('warehouses')->with('success', 'Data berhasil dihapus');
    }
}
