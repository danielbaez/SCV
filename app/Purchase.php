<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
}
