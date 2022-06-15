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
        }, 'REQUEST-PICKUP')->groupBy('cargos.id')->get()->count();

        $atWarehouse = Cargo::select('cargos.id')
        ->join('cargo_details', 'cargos.id', 'cargo_details.cargo_id')
        ->where(function($query) {
            $query->select('delivery_status')
                ->from('cargo_details')
                ->whereColumn('cargo_id', 'cargos.id')
                ->latest()
                ->limit(1);
        }, 'RECEIVED-AT-WAREHOUSE')->groupBy('cargos.id')->get()->count();

        $atWarehouse = Cargo::select('cargos.id')
        ->join('cargo_details', 'cargos.id', 'cargo_details.cargo_id')
        ->where(function($query) {
            $query->select('delivery_status')
                ->from('cargo_details')
                ->whereColumn('cargo_id', 'cargos.id')
                ->latest()
                ->limit(1);
        }, 'RECEIVED-AT-WAREHOUSE')->groupBy('cargos.id')->get()->count();

        $deliveringToClient = Cargo::select('cargos.id')
        ->join('cargo_details', 'cargos.id', 'cargo_details.cargo_id')
        ->where(function($query) {
            $query->select('delivery_status')
                ->from('cargo_details')
                ->whereColumn('cargo_id', 'cargos.id')
                ->latest()
                ->limit(1);
        }, 'DELIVERING-BY-COURIER')->groupBy('cargos.id')->get()->count();

        $delivered = Cargo::select('cargos.id')
        ->join('cargo_details', 'cargos.id', 'cargo_details.cargo_id')
        ->where(function($query) {
            $query->select('delivery_status')
                ->from('cargo_details')
                ->whereColumn('cargo_id', 'cargos.id')
                ->latest()
                ->limit(1);
        }, 'DELIVERED')->groupBy('cargos.id')
        ->get()->count();

        $earningsAllTime = Cargo::select('cargos.id', 'cargos.total_price')
        ->join('cargo_details', 'cargos.id', 'cargo_details.cargo_id')
        ->where(function($query) {
            $query->select('delivery_status')
                ->from('cargo_details')
                ->whereColumn('cargo_id', 'cargos.id')
                ->latest()
                ->limit(1);
        }, 'DELIVERED')
        ->groupBy('cargos.id')
        ->get()->sum('total_price');

        $earningsThisMonth = Cargo::select('cargos.id', 'cargos.total_price')
        ->join('cargo_details', 'cargos.id', 'cargo_details.cargo_id')
        ->where(function($query) {
            $query->select('delivery_status')
                ->from('cargo_details')
                ->whereColumn('cargo_id', 'cargos.id')
                ->latest()
                ->limit(1);
        }, 'DELIVERED')
        ->where('cargos.created_at', '>=', now()->startOfMonth())->where('cargos.created_at', '<=', now()->endOfMonth())
        ->groupBy('cargos.id')
        ->get()->sum('total_price');

        $earningsThisWeek = Cargo::select('cargos.id', 'cargos.total_price')
        ->join('cargo_details', 'cargos.id', 'cargo_details.cargo_id')
        ->where(function($query) {
            $query->select('delivery_status')
                ->from('cargo_details')
                ->whereColumn('cargo_id', 'cargos.id')
                ->latest()
                ->limit(1);
        }, 'DELIVERED')
        ->where('cargos.created_at', '>=', now()->startOfWeek())->where('cargos.created_at', '<=', now()->endOfWeek())
        ->groupBy('cargos.id')
        ->get()->sum('total_price');

        $earningsThisDay = Cargo::select('cargos.id', 'cargos.total_price')
        ->join('cargo_details', 'cargos.id', 'cargo_details.cargo_id')
        ->where(function($query) {
            $query->select('delivery_status')
                ->from('cargo_details')
                ->whereColumn('cargo_id', 'cargos.id')
                ->latest()
                ->limit(1);
        }, 'DELIVERED')
        ->where('cargos.created_at', '>=', now()->startOfDay())->where('cargos.created_at', '<=', now()->endOfDay())
        ->groupBy('cargos.id')
        ->get()->sum('total_price');

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
