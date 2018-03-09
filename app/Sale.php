<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'user_id', 'customer_id', 'voucher', 'voucher_serie', 'voucher_number', 'total', 'date', 'state'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function sale_detail()
    {
        return $this->hasMany(Sale_detail::class);
    }
}
