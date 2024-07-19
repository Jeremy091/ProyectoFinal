<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Role extends Model implements Auditable
{   
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    public static $rules = [
        
    ];
    //Relacion muchos a muchos con permisos
    public function permisos(){
        return $this->belongsToMany('App\Models\Permiso');
    }
    //Relacion muchos a muchos con usuarios/users
    public function users(){
        return $this->belongsToMany('App\Models\User');
    }
}
