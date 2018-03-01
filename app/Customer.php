<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 'lastname', 'document', 'address', 'phone', 'state'
    ];
}
