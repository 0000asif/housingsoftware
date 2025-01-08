<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentAdjustment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rent_id',
        'renter_id',
        'adjustment_date',
        'month',
        'year',
        'monthly_rent',
        'electracity_bill',
        'water_bill',
        'gas_bill',
        'gatmanbill',
        'lift_bill',
        'garage_bill',
        'service_charge',
        'note',
    ];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rent()
    {
        return $this->belongsTo(Rent::class);
    }

    public function renter()
    {
        return $this->belongsTo(Renter::class);
    }
}
