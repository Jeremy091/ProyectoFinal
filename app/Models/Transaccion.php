<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class Transaccion extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $primaryKey = 'transaccion_id';
    public static $rules = [
        
    ];

    protected $fillable = ['fecha_transaccion', 'total_transaccion', 'metodo_pago', 'tipo_transaccion', 'cliente_id'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'cliente_id');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'producto_transaccion', 'transaccion_id', 'producto_id')
                    ->withPivot('cantidad', 'precio_unitario')
                    ->withTimestamps();
    }
}


