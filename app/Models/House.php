<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'house_name',
        'owner_name',
        'contract_number',
        'holding_number',
        'address',
        'land_info',
        'opening_balance',
        'document',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
