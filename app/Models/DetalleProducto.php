<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleProducto extends Model
{
    use HasFactory;

    protected $table = 'Detalle_Producto';
    protected $primaryKey = 'Detalle_id';
    public $timestamps = false;

    protected $fillable = ['Empleado_id', 'Producto_id', 'Categoria_id', 'Descripción', 'Estado', 'Precio', 'stock', 'Imagen_Url'];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'Empleado_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'Producto_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'Categoria_id');
    }
}
