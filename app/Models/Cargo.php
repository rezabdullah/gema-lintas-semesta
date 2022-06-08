<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'partner_id',
        'cost_rate_id',
        'package_description',
        'quantity',
        'weight',
        'price',
        'total_price',
        'sender_address',
        'recipient_name',
        'recipient_phone',
        'recipient_address',
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class)->withTrashed();
    }

    public function costRate()
    {
        return $this->belongsTo(CostRate::class)->withTrashed();
    }

    public function cargoDetails()
    {
        return $this->hasMany(CargoDetail::class);
    }
}
