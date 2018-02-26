<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'name', 'serie', 'from', 'to', 'state'
    ];
}
