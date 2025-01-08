<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remainder extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'renter_id', 'note', 'date', 'status'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function renter()
    {
        return $this->belongsTo(Renter::class, 'renter_id', 'id');
    }
}
