<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'Producto';
    protected $primaryKey = 'Producto_id';
    public $timestamps = false;

    protected $fillable = ['Codigo_prod', 'Nombre'];

    public function detallesProducto()
    {
        return $this->hasMany(DetalleProducto::class, 'Producto_id');
    }
}
