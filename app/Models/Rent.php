<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'renter_id',
        'rent_date',
        'house_id',
        'floor_id',
        'unit_id',
        'monthly_rent',
        'electracity_bill',
        'water_bill',
        'gas_bill',
        'gatmanbill',
        'lift_bill',
        'car_reg_no',
        'quantity',
        'garage_bill',
        'service_charge',
        'advance',
        'member',
        'status',
    ];

    // Define relationships if necessary
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function renter()
    {
        return $this->belongsTo(Renter::class);
    }

    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
