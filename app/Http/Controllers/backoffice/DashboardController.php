<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pickupRequest = Cargo::select('cargos.id')
        ->join('cargo_details', 'cargos.id', 'cargo_details.cargo_id')
        ->where(function($query) {
            $query->select('delivery_status')
                ->from('cargo_details')
                ->whereColumn('cargo_id', 'cargos.id')
                ->latest()
                ->limit(1);
        }, 'REQUEST-PICKUP')->count();

        $atWarehouse = Cargo::select('cargos.id')
        ->join('cargo_details', 'cargos.id', 'cargo_details.cargo_id')
        ->where(function($query) {
            $query->select('delivery_status')
                ->from('cargo_details')
                ->whereColumn('cargo_id', 'cargos.id')
                ->latest()
                ->limit(1);
        }, 'RECEIVED-AT-WAREHOUSE')->count();

        $atWarehouse = Cargo::select('cargos.id')
        ->join('cargo_details', 'cargos.id', 'cargo_details.cargo_id')
        ->where(function($query) {
            $query->select('delivery_status')
                ->from('cargo_details')
                ->whereColumn('cargo_id', 'cargos.id')
                ->latest()
                ->limit(1);
        }, 'RECEIVED-AT-WAREHOUSE')->count();

        $deliveringToClient = Cargo::select('cargos.id')
        ->join('cargo_details', 'cargos.id', 'cargo_details.cargo_id')
        ->where(function($query) {
            $query->select('delivery_status')
                ->from('cargo_details')
                ->whereColumn('cargo_id', 'cargos.id')
                ->latest()
                ->limit(1);
        }, 'DELIVERING-BY-COURIER')->count();

        $delivered = Cargo::select('cargos.id')
        ->join('cargo_details', 'cargos.id', 'cargo_details.cargo_id')
        ->where(function($query) {
            $query->select('delivery_status')
                ->from('cargo_details')
                ->whereColumn('cargo_id', 'cargos.id')
                ->latest()
                ->limit(1);
        }, 'DELIVERED')->count();

        $earningsAllTime = Cargo::sum('total_price');
        $earningsThisMonth = Cargo::where('created_at', '>=', now()->startOfMonth())->where('created_at', '<=', now()->endOfMonth())->sum('total_price');
        $earningsThisWeek = Cargo::where('created_at', '>=', now()->startOfWeek())->where('created_at', '<=', now()->endOfWeek())->sum('total_price');
        $earningsThisDay = Cargo::where('created_at', '>=', now()->startOfDay())->where('created_at', '<=', now()->endOfDay())->sum('total_price');

        return view('backoffice.dashboard.index', compact(
            'pickupRequest', 'atWarehouse', 
            'deliveringToClient', 'delivered',
            'earningsAllTime', 'earningsThisMonth', 
            'earningsThisWeek', 'earningsThisDay'
        ));
    }

    public function trackingShipment(Request $request)
    {
        $request->validate([
            'tracking_number' => 'required|exists:cargos,id',
        ]);

        return redirect()->route('shipments.show', $request->tracking_number);
    }
}
