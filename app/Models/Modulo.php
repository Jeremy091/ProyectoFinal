<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class Modulo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory;
    //Relacon muchos a muchos con usuarios
    public function usuarios()
    {
        return $this->belongsToMany('App\Models\User');
    }

    protected $primaryKey = 'modulo_id';
    public static $rules = [
        
    ];
}
