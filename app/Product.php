<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'brand_id', 'presentation_id', 'name', 'minimum_stock', 'stock', 'purchase_price', 'sale_price', 'barcode', 'state'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function presentation()
    {
        return $this->belongsTo(Presentation::class);
    }
}
