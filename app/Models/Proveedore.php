<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Proveedore extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'proveedores';
    protected $primaryKey = 'proveedor_id';
    protected $fillable = ['nombre_proveedor', 'ruc', 'direccion_proveedor', 'telefono_proveedor', 'email_proveedor'];

    public static $rules = [
        'nombre_proveedor' => 'required|string|max:255',
        'ruc' => 'required|string|max:20|unique:proveedores,ruc',
        'direccion_proveedor' => 'required|string|max:255',
        'telefono_proveedor' => 'required|string|max:20',
        'email_proveedor' => 'required|email|unique:proveedores,email_proveedor',
    ];

    public function compras()
    {
        return $this->hasMany(Compra::class, 'proveedor_id', 'proveedor_id');
    }
}