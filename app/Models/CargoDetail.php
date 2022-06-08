<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CargoDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'cargo_id',
        'user_id',
        'warehouse_id',
        'delivery_status',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class)->withTrashed();
    }
}
