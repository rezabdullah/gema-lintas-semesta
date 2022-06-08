<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'code',
        'name',
        'email',
        'phone',
        'address',
        'status',
    ];

    public function cost_rates()
    {
        return $this->hasMany(CostRate::class);
    }
}
