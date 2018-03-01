<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = [
        'business_name', 'name', 'lastname', 'document', 'address', 'phone', 'state'
    ];
}
