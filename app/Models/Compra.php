<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Compra extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'compras';
    protected $primaryKey = 'compra_id';
    protected $fillable = ['fecha_compra', 'total_compra', 'metodo_pago', 'proveedor_id', 'numero_factura'];

    public static $rules = [
        'fecha_compra' => 'required|date',
        'total_compra' => 'required|numeric',
        'metodo_pago' => 'required|string|max:30',
        'proveedor_id' => 'required|exists:proveedores,proveedor_id',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedore::class, 'proveedor_id', 'proveedor_id');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleCompra::class, 'compra_id', 'compra_id');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'compra_producto', 'compra_id', 'producto_id')
            ->withPivot('cantidad', 'precio_compra');
    }
}
