<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presentation extends Model
{
    protected $fillable = ['name', 'state'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
