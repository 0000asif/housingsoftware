<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renter extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'nid',
        'phone',
        'gender',
        'birth_date',
        'regnumber',
        'occupation',
        'institute',
        'other_info',
        'address',
        'status',
        'note',
        'pdf_file',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
