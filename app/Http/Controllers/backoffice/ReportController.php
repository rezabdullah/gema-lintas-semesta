<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function invoice()
    {
        $cargos = Cargo::select('cargos.id', 'cargos.package_description', 'cargos.quantity', 'cargos.weight', 'cargos.total_price', 
        'partners.name', 'partners.email', 'partners.phone', 
        'partners.address', 'cargo_details.delivery_status', 'cargo_details.created_at')
        ->join('partners', 'cargos.partner_id', 'partners.id')
        ->join('cargo_details', 'cargos.id', 'cargo_details.cargo_id')
        ->where(function($query) {
            $query->select('delivery_status')
            ->from('cargo_details')
            ->whereColumn('cargo_id', 'cargos.id')
            ->where('delivery_status', 'DELIVERED');
        })
        ->groupBy('cargos.id')
        ->orderBy('cargos.created_at', 'desc')
        ->get();

        // dd($cargos->toArray());

        return view('backoffice.reports.invoice', compact('cargos'));
    }

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
            ->where('delivery_status', 'DELIVERING')
            ->orWhere('delivery_status', 'DELIVERING-BY-COURIER')
            ;
        })
        ->groupBy('cargos.id')
        ->orderBy('cargos.created_at', 'desc')
        ->get();

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
            ->where('delivery_status', 'DELIVERED');
        })
        ->groupBy('cargos.id')
        ->orderBy('cargos.created_at', 'desc')
        ->get();

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
            ->where('delivery_status', 'RECEIVED-AT-WAREHOUSE');
        })
        ->groupBy('cargos.id')
        ->orderBy('cargos.created_at', 'desc')
        ->get();

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
