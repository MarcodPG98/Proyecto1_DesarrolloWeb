<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class empleado extends Model
{
    protected $table = 'empleado';
    protected $primaryKey = 'id_empleado';
    public $timestamps = false;

    use HasFactory;
    protected $fillable = [
        'nombres', 
        'apellidos',
        'dpi'
    ];

    public function usuario()
    {
        return $this->belongsToMany(usuario::class, 'usuario', 'id_empleado','id_usuario');
    }
}
