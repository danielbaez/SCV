<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'state'];

    public function brands()
    {
        return $this->hasMany(Brand::class);
    }
}
