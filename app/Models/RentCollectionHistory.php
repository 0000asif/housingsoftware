<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentCollectionHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'monthly_rent_id',
        'rent_id',
        'amount_paid',
        'payment_date',
        'month',
        'year',
        'payment_method',
        'notes',
        'invoice',
        'status'
    ];

    public function monthly_rent()
    {
        return $this->belongsTo(MonthlyRent::class, 'monthly_rent_id');
    }
    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }
    public static function boot()
    {
        parent::boot();
        // Automatically delete the related BankTransaction when an Expense is deleted
        static::deleted(function ($expense) {
            $expense->transactions()->delete();
        });
    }
}
