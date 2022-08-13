<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function delivering()
    {
        $cargos = Cargo::select('cargos.id', 'cargos.package_description', 'cargos.quantity', 'cargos.weight', 
        'cost_rates.sender_sub_district', 'cost_rates.sender_city', 'cost_rates.destination_sub_district', 
        'cost_rates.destination_city', 'cargo_details.delivery_status', 'cargo_details.created_at')
        ->join('cost_rates', 'cargos.cost_rate_id', 'cost_rates.id')
        ->join('cargo_details', 'cargos.id', 'cargo_details.cargo_id')
        ->where(function($query) {
            $query->select('delivery_status')
                ->from('cargo_details')
                ->whereColumn('cargo_id', 'cargos.id')
                ->latest()
                ->limit(1);
        }, 'DELIVERING-BY-COURIER')
        ->orWhere(function($query) {
            $query->select('delivery_status')
                ->from('cargo_details')
                ->whereColumn('cargo_id', 'cargos.id')
                ->latest()
                ->limit(1);
        }, 'DELIVERING')->groupBy('cargos.id')->get();

        return view('backoffice.reports.delivering', compact('cargos'));
    }

    public function delivered()
    {
        $cargos = Cargo::select('cargos.id', 'cargos.package_description', 'cargos.quantity', 'cargos.weight', 
        'cost_rates.sender_sub_district', 'cost_rates.sender_city', 'cost_rates.destination_sub_district', 
        'cost_rates.destination_city', 'cargo_details.delivery_status', 'cargo_details.created_at')
        ->join('cost_rates', 'cargos.cost_rate_id', 'cost_rates.id')
        ->join('cargo_details', 'cargos.id', 'cargo_details.cargo_id')
        ->where(function($query) {
            $query->select('delivery_status')
                ->from('cargo_details')
                ->whereColumn('cargo_id', 'cargos.id')
                ->latest()
                ->limit(1);
        }, 'DELIVERED')->groupBy('cargos.id')->get();

        return view('backoffice.reports.delivered', compact('cargos'));
    }

    public function atWarehouse()
    {
        $cargos = Cargo::select('cargos.id', 'cargos.package_description', 'cargos.quantity', 'cargos.weight', 
        'cost_rates.sender_sub_district', 'cost_rates.sender_city', 'cost_rates.destination_sub_district', 
        'cost_rates.destination_city', 'cargo_details.delivery_status', 'cargo_details.created_at')
        ->join('cost_rates', 'cargos.cost_rate_id', 'cost_rates.id')
        ->join('cargo_details', 'cargos.id', 'cargo_details.cargo_id')
        ->where(function($query) {
            $query->select('delivery_status')
                ->from('cargo_details')
                ->whereColumn('cargo_id', 'cargos.id')
                ->latest()
                ->limit(1);
        }, 'RECEIVED-AT-WAREHOUSE')->groupBy('cargos.id')->get();

        return view('backoffice.reports.at-warehouse', compact('cargos'));
    }

    public function partner()
    {
        $partners =  Partner::all();

        return view('backoffice.reports.partner', compact('partners'));
    }

    public function admin()
    {
        $admins =  User::all();

        return view('backoffice.reports.admin', compact('admins'));
    }
}
