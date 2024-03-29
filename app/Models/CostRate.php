<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CostRate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'partner_id',
        'sender_sub_district',
        'sender_city',
        'sender_province',
        'destination_sub_district',
        'destination_city',
        'destination_province',
        'weight',
        'ctg_type',
        'cost',
        'transport_type',
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class)->withTrashed();
    }
}
