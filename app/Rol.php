<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Rol extends Model
{
	protected $table = 'Roles';

	protected $fillable = ['name', 'state'];

	public function users()
    {
        return $this->hasMany(User::class);
    }
}
