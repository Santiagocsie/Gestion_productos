<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'Categoria';
    protected $primaryKey = 'Categoria_id';
    public $timestamps = false;

    protected $fillable = ['Nombre_categoria'];

    public function detallesProducto()
    {
        return $this->hasMany(DetalleProducto::class, 'Categoria_id');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'detalle_producto', 'Categoria_id', 'Producto_id');
    }
    
}
