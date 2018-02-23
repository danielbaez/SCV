<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Rol;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'email', 'password', 'state', 'rol_id', 'document', 'birth_date', 'address', 'phone', 'phone', 'photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*public function getStateAttribute($value)
    {
        return $value == 1 ? 'Activo' : 'Inactivo';
    }*/

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }
}
