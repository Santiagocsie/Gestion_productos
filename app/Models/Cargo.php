<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $table = 'Cargo';
    protected $primaryKey = 'Cargo_id';
    public $timestamps = false;

    protected $fillable = ['Nombre', 'Rol', 'Descripcion'];

    public function contratos()
    {
        return $this->hasMany(Contratos::class, 'Cargo_id');
    }
}
