<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\CargoDetail;
use App\Models\CostRate;
use App\Models\Partner;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class CargoController extends Controller
{
    public function index()
    {
        $cargos = Cargo::with('partner')->with('costRate')->with(['cargoDetails' => function ($query) { 
            $query->with('user')->orderBy('id', 'desc');
        }])->paginate(env('TABLE_PAGINATE'));
        
        return view('backoffice.shipments.index', compact('cargos'));
    }

    public function show(Cargo $cargo)
    {
        $cargo->load('partner')->load('costRate')->load(['cargoDetails' => function ($query) { 
            $query->with('warehouse')->with('user')->orderBy('id', 'desc');
        }]);

        return view('backoffice.shipments.show', compact('cargo'));
    }

    public function createPickup()
    {
        $partners = Partner::all();
        $costRates = CostRate::all();
        
        return view('backoffice.shipments.pickup', compact('partners', 'costRates'));
    }

    public function storePickup(Request $request)
    {
        $request->validate([
            'partner_id' => 'required|numeric|exists:partners,id',
            'cost_rate_id' => 'required|numeric|exists:cost_rates,id',
            'package_description' => 'required',
            'quantity' => 'required|numeric',
            'weight' => 'required|numeric',
            'sender_address' => 'required',
            'recipient_name' => 'required',
            'recipient_phone' => 'required',
            'recipient_address' => 'required',
        ]);

        $price = CostRate::find($request->cost_rate_id)->cost;
        $totalPrice = $price * $request->quantity * $request->weight;

        $id = IdGenerator::generate(['table' => 'cargos', 'length' => 8, 'prefix' => 'RA']);

        $request->merge([
            'id' => $id,
            'price' => $price,
            'total_price' => $totalPrice,
        ]);

        $cargo = Cargo::create($request->all());

        CargoDetail::create([
            'cargo_id' => $cargo->id,
            'user_id' => auth()->user()->id,
            'warehouse_id' => auth()->user()->warehouse_id,
            'description' => 'Belum diambil',
            'delivery_status' => 'REQUEST-PICKUP',
        ]);
        
        return redirect()->route('shipments.pickup.create')->with('success', 'Shipment berhasil ditambahkan');
    }

    public function printDelivery(Cargo $cargo)
    {
        $cargo->load('partner')->load('costRate');

        return view('backoffice.shipments.print-delivery', compact('cargo'));
    }

    public function createDelivery(Cargo $cargo)
    {
        return view('backoffice.shipments.create-delivery', compact('cargo'));
    }

    public function storeDelivery(Cargo $cargo, Request $request)
    {
        $request->validate([
            'description' => 'required',
            'delivery_status' => 'required|in:PICKED-UP,DELIVERING,RECEIVED-AT-WAREHOUSE,DELIVERED',
        ]);

        CargoDetail::create([
            'cargo_id' => $cargo->id,
            'user_id' => auth()->user()->id,
            'warehouse_id' => auth()->user()->warehouse_id,
            'description' => $request->description,
            'delivery_status' => $request->delivery_status,
        ]);

        return redirect()->route('shipments.show', $cargo->id)->with('success', 'Shipment record berhasil ditambahkan');
    }

    public function destroyDelivery(CargoDetail $cargoDetail)
    {
        $cargoDetail->delete();

        return redirect()->route('shipments.show', $cargoDetail->cargo_id)->with('success', 'Shipment record berhasil dihapus');
    }
}
