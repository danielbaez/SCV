<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
	protected $fillable = [
        'user_id', 'provider_id', 'voucher', 'voucher_serie', 'voucher_number', 'total', 'date', 'state'
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function purchase_detail()
    {
        return $this->hasMany(Purchase_detail::class);
    }
}
