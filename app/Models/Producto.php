<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto'; // Nombre correcto de la tabla
    protected $primaryKey = 'Producto_id';
    public $timestamps = false;

    protected $fillable = [
        'Codigo_prod',
        'Nombre',
        'Estado',
        'Precio',
        'stock',
        'Descripcion',
    ];

    public function detallesProducto()
    {
        return $this->hasMany(DetalleProducto::class, 'Producto_id');
    }

    public function categorias()
{
    return $this->belongsToMany(Categoria::class, 'detalle_producto', 'Producto_id', 'Categoria_id');
}

}
