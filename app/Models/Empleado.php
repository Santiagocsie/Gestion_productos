<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Cambiar Model por Authenticatable

class Empleado extends Authenticatable // Extender Authenticatable
{
    use HasFactory;

    protected $table = 'Empleado'; // Asegurar que coincida con la BD
    protected $primaryKey = 'Empleado_id';
    public $timestamps = false;

    protected $fillable = ['Nombre', 'Correo', 'Contrasena', 'Telefono', 'Direccion', 'Fecha_nacimiento', 'Genero'];

    protected $casts = [
        'Contrasena' => 'string',
    ];

    public function contratos()
    {
        return $this->hasMany(Contrato::class, 'Empleado_id');
    }

    public function detallesProducto()
    {
        return $this->hasMany(DetalleProducto::class, 'Empleado_id');
    }

    public function getAuthPassword()
    {
        return $this->attributes['Contrasena']; // Asegurar que usa la clave correcta
    }
}
