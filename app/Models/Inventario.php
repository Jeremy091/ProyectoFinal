<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class Inventario extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $table = 'inventarios';
    protected $primaryKey = 'inventario_id';
    protected $fillable = [
        'producto_id',
        'stock',
        'fecha_ingreso',
        'fecha_movimiento',
        // 'tipo_movimiento',
    ];

    public static $rules = [];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'producto_id');
    }
}
