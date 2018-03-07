<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase_detail extends Model
{
	protected $table = 'purchase_detail';
	
    protected $fillable = [
        'purchase_id', 'product_id', 'quantity', 'price'
    ];
}
