<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historial_emp extends Model
{
    protected $table = 'historial_emp';
    protected $primaryKey = 'id_historial_emp';
    public $timestamps = false;

    use HasFactory;
    protected $fillable = [
        'fecha', 
        'hora',
        'id_usuario',
        'tipo_entrada'
    ];

    public function usuario()
    {
        return $this->belongsToMany(usuario::class, 'usuario', 'id_historial_emp','id_usuario');
    }
}
