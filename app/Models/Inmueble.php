<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inmueble extends Model
{
    use HasFactory;
    protected $table='inmuebles';
    protected $fillable=[
        'codigo',
        'descripcionGlosa',
        'fechaAdquisicion',
        'monto',
        'idUsuario',
        'idResponsable',
        'idEstado',
        'idGrupo',
        'idDireccion',
        'idInmueble'
    ];
    public $timestamps=false;

    public function usuario()
    {
        return $this->belongsTo(User::class,'idUsuario');
    }
    public function estado()
    {
        return $this->belongsTo(Estado::class,'idEstado');
    }
    public function direccion()
    {
        return $this->belongsTo(Direccion::class,'idDireccion');
    }
    public function grupo()
    {
        return $this->belongsTo(Grupo::class,'idGrupo');
    }
    public function responsable()
    {
        return $this->belongsTo(Responsable::class,'idResponsable');
    }
    public function inmueble()
    {
        return $this->belongsTo(Inmueble::class,'idInmueble');
    }

    // $inmueble -> images
    public function images(){
        return $this->hasMany(InmuebleImage::class);
    }
}
