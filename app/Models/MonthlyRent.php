<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyRent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rent_id',
        'month',
        'year',
        'total_amount',
        'advance_amount',
        'collection_amount',
        'note',
        'date',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function rent()
    {
        return $this->belongsTo(Rent::class, 'rent_id', 'id');
    }
    public function collectionHistory()
    {
        return $this->hasMany(RentCollectionHistory::class, 'monthly_rent_id');
    }
}
