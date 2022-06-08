<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'cargo_id',
        'user_id',
        'warehouse_id',
        'delivery_status',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
