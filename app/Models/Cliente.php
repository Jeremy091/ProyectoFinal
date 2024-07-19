<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class Cliente extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $primaryKey = 'cliente_id';
    public static $rules = [
        
    ];

    protected $fillable = [
        'nombre_cliente',
        'apellido_cliente',
        'direccion_cliente',
        'telefono_cliente',
        'email_cliente',
        'cedula_cliente',
    ];

    public function transaccions()
    {
        return $this->hasMany(Transaccion::class, 'cliente_id', 'cliente_id');
    }

}
