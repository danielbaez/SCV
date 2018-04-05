<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
	protected $table = 'inventory';
	
    protected $fillable = [
        'product_id', 'table_id', 'initial_balance', 'input', 'output', 'balance'
    ];
}
