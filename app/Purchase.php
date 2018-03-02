<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
