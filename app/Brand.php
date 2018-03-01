<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name', 'state'];

    public function presentations()
    {
        return $this->hasMany(Presentacion::class);
    }
}
