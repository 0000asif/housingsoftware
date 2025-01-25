<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'house_id',
        'floor_id',
        'name',
        'info',
        'status',
        'rent_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function house()
    {
        return $this->belongsTo(House::class, 'house_id', 'id');
    }
    public function floor()
    {
        return $this->belongsTo(Floor::class, 'floor_id', 'id');
    }
}
