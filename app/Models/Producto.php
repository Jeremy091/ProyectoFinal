<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class Producto extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $table = 'productos';
    protected $primaryKey = 'producto_id';
    protected $fillable = ['nombre_producto', 'descripcion_producto', 'precio_unitario','precio_compra', 'categoria_id'];
    public static $rules = [];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'categoria_id');
    }

    public function inventarios()
    {
        return $this->hasMany(Inventario::class, 'producto_id', 'producto_id');
    }

    public function transaccions()
    {
        return $this->belongsToMany(Transaccion::class, 'producto_transaccion', 'producto_id', 'transaccion_id')
                    ->withPivot('cantidad', 'precio_unitario')
                    ->withTimestamps();
    }
    
    // Definir la relación muchos a muchos
    public function compras()
    {
        return $this->belongsToMany(Compra::class, 'compra_producto', 'producto_id', 'compra_id');
    }
}


