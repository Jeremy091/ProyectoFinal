<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class Permiso extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    public static $rules = [
        
    ];
    //Relacion muchos a muchos con roles
    public function roles(){
        return $this->belongsToMany('App\Models\Role');
    }
}
