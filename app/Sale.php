<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Sale extends Model
{
    protected $fillable = [
        'user_id', 'customer_id', 'voucher', 'voucher_serie', 'voucher_number', 'tax', 'tax_percentage', 'total', 'date', 'state'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function sale_detail()
    {
        return $this->hasMany(Sale_detail::class);
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y h:i:s A');
    }
}
