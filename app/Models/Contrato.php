<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $table = 'Contrato';
    protected $primaryKey = 'Contrato_id';
    public $timestamps = false;

    protected $fillable = ['Empleado_id', 'Cargo_id', 'Tipo_contrato', 'Fecha_inicio', 'Fecha_fin', 'Salario'];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'Empleado_id');
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'Cargo_id');
    }
}
