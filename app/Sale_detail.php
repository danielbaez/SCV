<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale_detail extends Model
{
    protected $table = 'sales_details';
	
    protected $fillable = [
        'sale_id', 'product_id', 'quantity', 'price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
