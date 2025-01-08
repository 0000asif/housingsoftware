<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStatement extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function rent()
    {
        return $this->belongsTo(Rent::class);
    }

    public function monthlyRent()
    {
        return $this->belongsTo(MonthlyRent::class);
    }
}
