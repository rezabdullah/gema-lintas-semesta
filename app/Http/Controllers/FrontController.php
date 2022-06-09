<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function trackingPost(Request $request)
    {
        $request->validate([
            'tracking_number' => 'required|exists:cargos,id',
        ]);

        return redirect()->route('front.tracking.get', $request->tracking_number);
    }

    public function trackingGet(Cargo $cargo)
    {
        $cargo->load('partner')->load('costRate')->load(['cargoDetails' => function ($query) { 
            $query->with('warehouse')->orderBy('id', 'desc');
        }]);

        return view('tracking', compact('cargo'));
    }
}
