<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'Empleado';
    protected $primaryKey = 'Empleado_id';
    public $timestamps = false;

    protected $fillable = ['Nombre', 'Correo', 'Contrasena', 'Telefono', 'Direccion', 'Fecha_nacimiento', 'Genero'];

    public function contratos()
    {
        return $this->hasMany(Contrato::class, 'Empleado_id');
    }

    public function detallesProducto()
    {
        return $this->hasMany(DetalleProducto::class, 'Empleado_id');
    }
}
