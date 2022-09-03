<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    protected $dato = 'contrasena';
    public $timestamps = false;

    use HasFactory;
    protected $fillable = [
        'usuario', 
        'contrasena',
        'id_empleado',
        'tipo_empleado'
    ];

    public function empleado()
    {
        return $this->belongsToMany(empleado::class, 'empleado', 'id_usuario','id_empleado');
    }

    public function historial_emp()
    {
        return $this->belongsToMany(historial_emp::class, 'historial_emp', 'id_usuario','id_historial_emp');
    }
}
