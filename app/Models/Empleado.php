<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Empleado extends Authenticatable
{
    use HasFactory;

    protected $table = 'empleado'; // Nombre correcto de la tabla
    protected $primaryKey = 'Empleado_id';
    public $timestamps = false;

    protected $fillable = ['Nombre', 'Email', 'Contrasena', 'Telefono', 'Direccion', 'Fecha_nacimiento', 'Genero'];

    protected $hidden = ['Contrasena'];

    public function contratos()
    {
        return $this->hasMany(Contrato::class, 'Empleado_id');
    }

    public function contratoActual()
    {
        return $this->hasOne(Contrato::class, 'Empleado_id')->latest('Fecha_inicio');
    }

    public function cargo()
    {
        return $this->hasOneThrough(
            Cargo::class,
            Contrato::class,
            'Empleado_id', // Llave foránea en Contrato
            'Cargo_id',    // Llave foránea en Cargo
            'Empleado_id', // Llave primaria en Empleado
            'Cargo_id'     // Llave primaria en Contrato
        );
    }

    public function getAuthPassword()
    {
        return $this->Contrasena;
    }
}
